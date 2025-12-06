<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'question',
        'answer',
        'order',
    ];

    // Relationship: FAQ belongs to Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}