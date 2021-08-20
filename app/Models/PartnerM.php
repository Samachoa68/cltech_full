<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'partner_name', 'partner_image','partner_link'
    ];
    protected $primaryKey = 'partner_id';
    protected $table = 'tbl_partners';
}
