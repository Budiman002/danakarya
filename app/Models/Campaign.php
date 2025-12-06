<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'target_amount',
        'current_amount',
        'deadline',
        'image',
        'video_url',
        'status',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'deadline' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($campaign) {
            if (empty($campaign->slug)) {
                $campaign->slug = Str::slug($campaign->title);
            }
        });
    }

    // Relationship: Campaign belongs to User (Creator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Campaign belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Campaign has many Donations
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Relationship: Campaign has many Updates
    public function updates()
    {
        return $this->hasMany(CampaignUpdate::class);
    }

    // Relationship: Campaign has many FAQs
    public function faqs()
    {
        return $this->hasMany(CampaignFaq::class)->orderBy('order');
    }

    // Relationship: Campaign has many Disbursements
    public function disbursements()
    {
        return $this->hasMany(Disbursement::class);
    }
}