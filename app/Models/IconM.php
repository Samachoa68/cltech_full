<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'icon_name', 'icon_image','icon_link'
    ];
    protected $primaryKey = 'icon_id';
    protected $table = 'tbl_icons';
}
