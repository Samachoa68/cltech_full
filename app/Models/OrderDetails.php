<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'order_code', 'product_id','product_name', 'product_coupon','product_price', 'product_feeship', 'product_sales_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function product()
    {
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}



