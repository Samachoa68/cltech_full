<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //public $timestamp = false;
    protected $fillable = [
    	'meta_keywords','category_name', 'category_desc', 'category_status','slug_category_product','category_parent','category_order'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
    public function product(Type $var = null)
    {
        return $this->hasMany('App\Models\Product');
    }
}
