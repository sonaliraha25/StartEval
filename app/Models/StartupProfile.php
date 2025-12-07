<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupProfile extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id', 'business_name', 'business_tagline', 'industry',
    'website', 'description', 'owner_name', 'logo',
    'revenue_data', 'sales_data', 'tax_receipt', 'has_missing_data',
    'missing_fields',
];

protected $casts = [
    'revenue_data' => 'array',
    'sales_data' => 'array',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reports()
{
    return $this->hasMany(StartupReport::class);
}

}
