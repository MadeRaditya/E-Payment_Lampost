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
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
