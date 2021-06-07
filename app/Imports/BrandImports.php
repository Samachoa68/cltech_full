<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;

class BrandImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Brand([
            'brand_id' => $row[0],            
            'brand_name' => $row[1],
            'brand_slug' => $row[2],
            'meta_keywords' => $row[3],
            'brand_desc' => $row[4],
            'brand_status' => $row[5],
        ]);
    }
}
