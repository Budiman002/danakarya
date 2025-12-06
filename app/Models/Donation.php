<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campaign_id',
        'amount',
        'payment_method',
        'payment_proof',
        'status',
        'transaction_code',
        'message',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($donation) {
            if (empty($donation->transaction_code)) {
                $donation->transaction_code = 'DN' . time() . rand(1000, 9999);
            }
        });
    }

    // Relationship: Donation belongs to User (Backer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Donation belongs to Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}