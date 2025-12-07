<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'startup_profile_id',
        'message',
        'is_read',
    ];

    public function startupProfile()
    {
        return $this->belongsTo(StartupProfile::class);
    }
}

