<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'comment_name', 'comment','comment_date', 'comment_product_id'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
}
