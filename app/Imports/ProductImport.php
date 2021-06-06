<?php

namespace App\Imports;

use App\Models\Product;
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
        return new Product([
            'product_id'=> $row[0],
            'category_id'=> $row[1],
            'brand_id'=> $row[2], 
            'product_name'=> $row[3],
            'product_slug'=> $row[4],
            'product_quantity'=> $row[5], 
            'product_sold'=> $row[6],
            'product_desc'=> $row[7], 
            'product_content'=> $row[8], 
            'product_price'=> $row[9], 
            'product_image'=> $row[10], 
            'product_status' => $row[11],
        ]);
    }
}
