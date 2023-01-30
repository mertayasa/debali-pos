<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
