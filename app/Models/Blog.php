<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

   class Blog extends Model
{
    protected $fillable = [
    'title',
    'slug',
    'short_description',
    'long_description',
    'image',
    'posted_at',
];

  protected $casts = [
        'posted_at' => 'datetime',
    ];
}


