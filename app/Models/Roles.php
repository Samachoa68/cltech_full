<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'roles_name'
    ];
    protected $primaryKey = 'roles_id';
    protected $table = 'tbl_roles';

    public function admin()
    {
    	return $this->belongsToMany('App\Models\Admin');
    }
}
