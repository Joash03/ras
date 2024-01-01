<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function webcarts()
    {
        return $this->hasMany(WebCart::class, 'item_id', 'id');
    }

    public function productinventory()
    {
        return $this->hasOne(ProductInventory::class, 'product_id', 'id');
    }
}
