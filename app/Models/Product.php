<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'user_id', 'title', 'status', 'description',
    'revenue', 'profit', 'asking_price',
    'logo', 'product_type', 'admin_rating',
];
public function user()
{
    return $this->belongsTo(User::class);
}

}
