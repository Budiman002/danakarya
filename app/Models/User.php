<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship: User has many Campaigns (as Creator)
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    // Relationship: User has many Donations (as Backer)
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Helper: Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper: Check if user is creator
    public function isCreator()
    {
        return $this->role === 'creator';
    }

    // Helper: Check if user is backer
    public function isBacker()
    {
        return $this->role === 'backer';
    }
}