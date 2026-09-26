<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

protected $fillable = [
        'invoice_number',
        'created_by',
        'amount',
        'description',
        'category',
        'subcategory',
        'ad_title',
        'ad_format',
        'ad_text',
        'media_files',
        'billing_name',
        'billing_npwp_nik',
        'billing_email',
        'billing_phone',
        'billing_address',
        'payment_preference',
        'advertiser_name',
        'advertiser_contact',
        'ad_slot',
        'ad_duration_days',
        'ad_start_date',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
        'ad_start_date' => 'date',
        'amount' => 'decimal:2',
        'media_files' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public static function calculatePrice(?string $formatKey, int $durationDays): float
    {
        $formats = config('ad_booking.formats', []);
        if (!$formatKey || !isset($formats[$formatKey])) {
            return 0;
        }
        $f = $formats[$formatKey];
        return (float) ($f['base_price'] + ($f['per_day'] * max(1, $durationDays)));
    }
}
