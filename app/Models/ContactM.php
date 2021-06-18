<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'info_contact', 'info_map', 'info_fanpage', 'info_logo'
    ];
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_information';
}
