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
        'platform_fee',
        'net_amount',
        'bank_name',
        'account_number',
        'account_holder',
        'status',
        'creator_notes',
        'admin_note',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    // Relationship: Disbursement belongs to Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // Get creator through campaign
    public function creator()
    {
        return $this->hasOneThrough(User::class, Campaign::class, 'id', 'id', 'campaign_id', 'user_id');
    }

    // Status checks
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}