<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'reference', 'reference');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'item_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }
}
