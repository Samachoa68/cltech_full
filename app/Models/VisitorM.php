<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'ip_address','date_visitor'
    ];
    protected $primaryKey = 'visitor_id';
    protected $table = 'tbl_visitors';
}
