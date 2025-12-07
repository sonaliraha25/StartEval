<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\startupProfile;

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
        'account_type',
    ];
      protected $appends = ['avatar_url'];

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
public function startupProfile()
{
    return $this->hasOne(StartupProfile::class, 'user_id', 'id');
}

public function investorProfile()
{
    return $this->hasOne(InvestorProfile::class, 'user_id', 'id');
}

public function getAvatarUrlAttribute()
{
    // If Startup has logo
    if ($this->startupProfile && $this->startupProfile->logo) {
        return asset('storage/' . $this->startupProfile->logo);
    }

    // If Investor has profile picture
    if ($this->investorProfile && $this->investorProfile->profile_picture) {
        return asset('storage/' . $this->investorProfile->profile_picture);
    }

    // Otherwise fallback
    return asset('avatars/' . ($this->avatar ?? 'avatar.png'));
}



}
