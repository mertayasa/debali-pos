<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'side_note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function sale_etails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
