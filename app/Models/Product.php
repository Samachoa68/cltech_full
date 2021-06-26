<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
    	'category_id', 'brand_id', 'product_name','product_slug', 'product_quantity', 'product_sold','product_desc', 'product_content', 'product_price', 'product_image','product_status','product_tags','product_views'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function comment()
    {
        return $this->hasMany('App\Models\CommentM');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','product_id');
    }

}
