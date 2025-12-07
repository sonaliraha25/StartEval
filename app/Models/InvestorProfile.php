<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id', 'full_name', 'email', 'phone', 'company', 'website',
    'investment_sectors', 'bio', 'funding_range', 'profile_picture',
];

protected $casts = [
    'investment_sectors' => 'array',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
