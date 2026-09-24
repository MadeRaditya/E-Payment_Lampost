<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        Log::info('Midtrans Webhook Received:', $payload);

        if (!isset($payload['order_id'], $payload['status_code'], $payload['gross_amount'], $payload['signature_key'])){
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        if (!$this->verifySignature($payload)) {
            Log::warning('Midtrans Webhook: Invalid signature', $payload);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $paymentId = $this->extractPaymentId($payload['order_id']);
        $payment = Payment::find($paymentId);

        if (!$payment) {
            Log::warning('Midtrans Webhook: Payment not found', ['order_id' => $payload['order_id']]);
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'] ?? 'accept';
        $paymentType = $payload['payment_type'] ?? null;

        DB::beginTransaction();
        try {
            $payment->update([
                'payment_method' => $paymentType,
                'gateway_response' => $payload,
            ]);

            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                if ($fraudStatus === 'accept') {
                    $this->handleSuccess($payment, $payload);
                }
            }
            elseif ($transactionStatus === 'pending') {
                $payment->update(['status' => 'pending']);
                $payment->invoice->update(['status' => 'unpaid']);
            }
            elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure'])) {
                $this->handleFailure($payment, $transactionStatus);
            }
            elseif ($transactionStatus === 'refund' || $transactionStatus === 'partial_refund') {
                $payment->update(['status' => 'failed']);
                $payment->invoice->update(['status' => 'failed']);
                Log::info('Payment refunded', ['payment_id' => $payment->id]);
            }

            DB::commit();

            return response()->json(['message' => 'OK'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Webhook Error: ' . $e->getMessage(), $payload);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    private function verifySignature(array $payload): bool
    {
        $serverKey = config('midtrans.server_key');
        $input = $payload['order_id'] . $payload['status_code'] . $payload['gross_amount'] . $serverKey;
        $calculatedSignature = hash('sha512', $input);

        return hash_equals($calculatedSignature, $payload['signature_key']);
    }

    private function extractPaymentId(string $orderId): ?int
    {
        $parts = explode('-', $orderId);
        return isset($parts[3]) ? (int) $parts[3] : null;
    }

    private function handleSuccess(Payment $payment, array $payload): void
    {
        if ($payment->status === 'success') {
            Log::info('Payment already marked as success, skipping.', ['payment_id' => $payment->id]);
            return;
        }

        $payment->update([
            'status' => 'success',
            'paid_at' => now(),
        ]);

        $payment->invoice->update(['status' => 'paid']);

        $this->generateReceipt($payment);

        Log::info('Payment Success:', [
            'payment_id' => $payment->id,
            'invoice_number' => $payment->invoice->invoice_number,
            'amount' => $payment->amount,
        ]);
    }

    private function handleFailure(Payment $payment, string $status): void
    {
        $paymentStatus = match ($status) {
            'expire' => 'expired',
            default => 'failed',
        };

        $payment->update(['status' => $paymentStatus]);

        if ($payment->invoice->status !== 'paid') {
            $payment->invoice->update(['status' => $paymentStatus === 'expired' ? 'expired' : 'failed']);
        }

        Log::info('Payment Failed:', [
            'payment_id' => $payment->id,
            'status' => $status,
        ]);
    }

    private function generateReceipt(Payment $payment): void
    {
        if ($payment->receipt) {
            return;
        }

        Receipt::create([
            'payment_id' => $payment->id,
            'receipt_number' => 'RCP-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            'file_path' => 'receipts/' . $payment->id . '.pdf', 
        ]);
    }
}

