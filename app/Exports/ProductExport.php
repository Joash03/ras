<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('name','category_id','supplier_id','code','thumbnail','description','purchase_date','expiry_date','purchase_price','sales_price')->get();
    }
}
