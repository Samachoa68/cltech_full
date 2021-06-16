<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentM extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
    	'comment_name', 'comment','comment_date', 'comment_product_id', 'comment_status', 'comment_parent_comment'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
    public function product()
    {
        return $this->belongsTo('App\Models\Product','comment_product_id');
    }
}
