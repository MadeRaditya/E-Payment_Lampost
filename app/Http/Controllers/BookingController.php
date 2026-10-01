<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    private function getDraft(): ?Invoice
    {
        $id = session('booking_invoice_id');
        if (!$id) return null;

        $invoice = Invoice::where('id', $id)
            ->where('status', 'draft')
            ->first();

        return $invoice;
    }

    public function step1(Request $request)
    {
        return view('public.booking.step-1', [
            'placementTypes'      => config('ad_booking.placement_types'),
            'categories'          => config('ad_booking.categories'),
            'formats'             => config('ad_booking.formats'),
            'draft'               => $this->getDraft(),
            'preselectedFormat'   => $request->query('format'),
            'preselectedCategory' => $request->query('category'),
        ]);
    }

    public function step1Store(Request $request)
    {
        $data = $request->validate([
            'placement_type' => 'required|in:online,offline',
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'ad_title' => 'required|string|max:150',
            'ad_format' => 'required|string',
        ]);

        $cats = config('ad_booking.categories');
        if (!isset($cats[$data['category']]) || !in_array($data['subcategory'], $cats[$data['category']])) {
            return back()->withErrors(['category' => 'Kategori tidak valid.'])->withInput();
        }

        $formats = config('ad_booking.formats');
        $fmt = $formats[$data['ad_format']] ?? null;
        if (!$fmt || $fmt['placement'] !== $data['placement_type']) {
            return back()->withErrors(['ad_format' => 'Format tidak sesuai dengan penempatan.'])->withInput();
        }

        $draft = $this->getDraft();

        if ($draft) {
            $draft->update($data);
        } else {
            $draft = Invoice::create(array_merge($data, [
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'created_by' => 1,
                'amount' => 0,
                'status' => 'draft',
                'description' => $data['ad_title'],
                'due_date' => now()->addDays(7),
                'ad_duration_days' => 7,
                'ad_start_date' => now()->addDay(),
            ]));
            session(['booking_invoice_id' => $draft->id]);
        }

        return redirect()->route('booking.step2');
    }

    public function step2()
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1')->with('error', 'Silakan mulai dari step 1.');

        return view('public.booking.step-2', [
            'formats' => config('ad_booking.formats'),
            'draft' => $draft,
        ]);
    }

    public function step2Store(Request $request)
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1');

        $data = $request->validate([
            'ad_text' => 'required|string|min:10|max:2000',
            'ad_start_date' => 'required|date|after_or_equal:today',
            'ad_duration_days' => 'required|integer|min:1|max:90',
        ]);

        $data['amount'] = Invoice::calculatePrice($draft->ad_format, $data['ad_duration_days']);
        $draft->update($data);

        return redirect()->route('booking.step3');
    }

    public function preview(Request $request)
    {
        $format = $request->input('ad_format');
        $duration = (int) $request->input('ad_duration_days', 1);
        $price = Invoice::calculatePrice($format, $duration);

        return response()->json([
            'price' => $price,
            'price_formatted' => 'Rp ' . number_format($price, 0, ',', '.'),
        ]);
    }

    public function step3()
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1');

        return view('public.booking.step-3', compact('draft'));
    }

    public function step3Store(Request $request)
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1');

        $request->validate([
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $existing = $draft->media_files ?? [];

        if ($request->hasFile('media')) {
            $folder = "bookings/{$draft->id}";
            foreach ($request->file('media') as $file) {
                $path = $file->store($folder, 'public');
                $existing[] = $path;
            }
        }

        $draft->update(['media_files' => $existing]);

        return redirect()->route('booking.step4');
    }

    public function step4()
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1');

        return view('public.booking.step-4', [
            'draft' => $draft,
            'formats' => config('ad_booking.formats'),
        ]);
    }

    public function step4Store(Request $request)
    {
        $draft = $this->getDraft();
        if (!$draft) return redirect()->route('booking.step1');

        $data = $request->validate([
            'billing_name'       => 'required|string|max:150',
            'billing_npwp_nik'   => 'required|string|max:50',
            'billing_email'      => 'required|email|max:150',
            'billing_phone'      => 'required|string|max:30',
            'billing_address'    => 'required|string|max:500',
            'payment_preference' => 'required|in:online,manual',
            'signature_data'     => 'required|string',
            'signed_by_name'     => 'required|string|max:150',
        ]);

        if (!preg_match('/^data:image\/png;base64,/', $data['signature_data'])) {
            return back()->withErrors(['signature_data' => 'Format tanda tangan tidak valid.'])->withInput();
        }

        if (strlen($data['signature_data']) > 700000) {
            return back()->withErrors(['signature_data' => 'Tanda tangan terlalu besar.'])->withInput();
        }

        $data['signed_at']    = now();
        $data['signed_ip']    = $request->ip();
        $data['status']       = 'unpaid';
        $data['advertiser_name']    = $data['billing_name'];
        $data['advertiser_contact'] = $data['billing_email'];
        $data['ad_slot']            = $draft->ad_format;
        $data['description']        = $draft->ad_title;

        $draft->update($data);

        session()->forget('booking_invoice_id');

        if ($data['payment_preference'] === 'online') {
            return redirect()->route('public.pay.show', $draft->invoice_number)
                ->with('success', 'Pesanan berhasil! Silakan lanjutkan pembayaran.');
        }

        return redirect()->route('public.pay.show', $draft->invoice_number)
            ->with('success', 'Pesanan berhasil! Silakan lakukan transfer manual sesuai instruksi.');
    }
}
