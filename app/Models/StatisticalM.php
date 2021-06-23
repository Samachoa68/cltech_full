<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticalM extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $fillable = [
		'order_date',  'sales','profit','order_date', 'total_order'
	];

	protected $primaryKey = 'statistical_id';
	protected $table = 'tbl_statistical';
}
