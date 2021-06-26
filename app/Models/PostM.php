<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostM extends Model
{
    use HasFactory;
    protected $fillable = [
    	'post_id','cate_post_id','post_slug','post_title','post_desc','post_content','post_meta_desc','post_meta_keywords','post_image','product_status','post_views'
    ];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';

    public function categorypost()
    {
    	return $this->belongsTo('App\Models\CategoryPost','cate_post_id');
    }

}
