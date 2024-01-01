<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductInventory;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = new Product([
            'name' => $row[0],
            'category_id' => $row[1],
            'supplier_id' => $row[2],
            'code' => $row[3],
            'thumbnail' => $row[4],
            'description' => $row[5],
            'purchase_date' => $row[6],
            'expiry_date' => $row[7],
            'purchase_price' => $row[8],
            'sales_price' => $row[9],
            'stock' => $row[10],
            'stock_status' => $row[11],
        ]);

        $product->save();

        $productInventory = new ProductInventory([
            'product_id' => $product->id,
            'purchase_date' => $row[6],
            'expiry_date' => $row[7],
            'purchase_price' => $row[8],
            'sales_price' => $row[9],
            'present_stock' => $row[10],
            'previous_stock' => $row[10],
        ]);

        $productInventory->save();

        return $product;
    }
}
