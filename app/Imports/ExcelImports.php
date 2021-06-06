<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
        	'category_id' => $row[0],
            'meta_keywords' => $row[1],
            'category_name' => $row[2],
            'slug_category_product' => $row[3],
            'category_desc' => $row[4],
            'category_status' => $row[5],
        ]);
    }
}
