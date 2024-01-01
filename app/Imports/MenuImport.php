<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;

class MenuImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Menu([
            'name' => $row[0],
            'category_id' => $row[1],
            'code' => $row[2],
            'thumbnail' => $row[3],
            'description' => $row[4],
            'price' => $row[5],
        ]);
    }
}
