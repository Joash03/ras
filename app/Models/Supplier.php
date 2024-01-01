<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }

    public function stores()
    {
        return $this->hasMany(StoreInventory::class, 'supplier_id', 'id');
    }
}
