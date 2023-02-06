<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'price',
        'side_note',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
