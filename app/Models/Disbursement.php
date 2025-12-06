<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'amount',
        'bank_name',
        'account_number',
        'account_holder',
        'status',
        'processed_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    // Relationship: Disbursement belongs to Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}