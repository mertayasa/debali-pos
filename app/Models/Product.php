<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
