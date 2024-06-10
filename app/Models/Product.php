<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'description', 'price', 'photo',
        'expiry_date', 'stock_quantity', 'sku'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getAllProducts()
    {
        return self::all();
    }

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }

    public function getFormattedExpiredAtAttribute()
    {
        return $this->expiry_date->format('d/m/Y');
    }
}

