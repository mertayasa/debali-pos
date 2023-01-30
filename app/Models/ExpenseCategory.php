<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
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

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
