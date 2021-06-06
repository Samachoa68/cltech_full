<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\Video;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CategoryPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class VideoController extends Controller
{
	public function AuthLogin()
	{
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('/dashboard');
		}else{
			return Redirect::to('/admin')->send();
		}
	}

	public function video()
	{	
		$this->AuthLogin();	
		return view('admin.video.list_video');		
	}
	
	public function delete_video(Request $request){
		$video_id = $request->video_id;
		$video = Video::find($video_id);
		$video->delete();
	}

	public function update_video_image(Request $request){
		$get_image = $request->file('file');
		$vid_id = $request->vid_id;
		if($get_image){
			$video = Video::find($vid_id);
			unlink('upload/videos/'.$video->video_image);
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.',$get_name_image));
			$new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
			$get_image->move('upload/videos',$new_image);
			$video->video_image = $new_image;
			$video->save(); 

		}
	}

	public function insert_video(Request $request){
		$data = $request->all();
		$video = new Video();
		$sub_link = substr($data['video_link'], 17);
		$video->video_title = $data['video_title'];
		$video->video_slug = $data['video_slug'];
		$video->video_desc = $data['video_desc'];
		$video->video_link = $sub_link;
		$video->video_status = $data['video_status'];  

		$get_image = $request->file('file');
		if($get_image){
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.',$get_name_image));
			$new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
			$get_image->move('upload/videos',$new_image);
			$video->video_image = $new_image;
		}

		$video->save();
	}

	public function update_video(Request $request){
		$data = $request->all();
		$video_id = $data['video_id'];
		$video_edit =  $data['video_edit'];
		$video_check =  $data['video_check'];
		$video = Video::find($video_id);
		
		if($video_check=='video_title'){    		
			$video->video_title = $video_edit;    		
		}
		elseif($video_check=='video_desc'){    		
			$video->video_desc = $video_edit;	    	
		}
		elseif($video_check=='video_link'){    		
			$sub_link = substr($video_edit, 17);
			$video->video_link = $sub_link;   	

		}else{     		
			$video->video_slug = $video_edit;	    	
		}
		$video->save();
	}

	public function select_video(Request $request)
	{
		$this->AuthLogin();
		$video = Video::orderBy('video_id')->get();
		$output = '	<form>
		'.csrf_field().'
		<table class="table table-striped b-t b-light">
		<thead>
		<tr>
		<th style="width:20px;">
		<label class="i-checks m-b-none">
		<input type="checkbox"><i></i>
		</label>
		</th>

		<th>STT</th>
		<th>Tên video</th>
		<th>Hình ảnh</th>
		<th>Slug</th>
		<th>Link</th>
		<th>Mô tả</th>
		<th>Demo</th>             
		<th style="width:30px;">Quản lý</th>
		</tr>
		</thead>
		<tbody>';
		if($video){
			$i = 0;
			foreach($video as $key => $v_vid){
				$i++;
				$output.='<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
				<td>'.$i.'</td>
				<td contenteditable data-video_id="'.$v_vid->video_id.'" data-video_type="video_title" class="video_edit" id="video_title_'.$v_vid->video_id.'">'.$v_vid->video_title.'</td>

				<td><img src="'.url('upload/videos/'.$v_vid->video_image).'" class="img-thumbnail" width="80" height="80">
				<input type="file" class="file_img_video"  data-vid_id="'.$v_vid->video_id.'" id="file-video-'.$v_vid->video_id.'" name="file" accept="image/*" />

				</td>

				

				<td contenteditable data-video_id="'.$v_vid->video_id.'" data-video_type="video_slug" class="video_edit" id="video_slug_'.$v_vid->video_id.'">'.$v_vid->video_slug.'</td>

				<td contenteditable data-video_id="'.$v_vid->video_id.'" data-video_type="video_link" class="video_edit" id="video_link_'.$v_vid->video_id.'">https://youtu.be/'.$v_vid->video_link.'
				</td>

				<td contenteditable data-video_id="'.$v_vid->video_id.'" data-video_type="video_desc" class="video_edit" id="video_desc_'.$v_vid->video_id.'">'.$v_vid->video_desc.'</td>

				<td><iframe width="200" height="200" src="https://www.youtube.com/embed/'.$v_vid->video_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>

				<td><button type="button" data-video_id="'.$v_vid->video_id.'" class="btn btn-xs btn-danger delete-video">Xóa</button></td>
				</tr>
				';
			}
		}else{
			$output.='
			<tr>
			<td colspan="4">Chưa có video</td>

			</tr>

			';
		}
		$output.='</tbody>
		</table>
		</form>';

		echo $output;
	}

	public function show_video(Request $request)
	{	
		$slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
		$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
		$meta_keywords = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
		$meta_title = "Home | LamGiaTech";
		$url_canonical = $request->url();

		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		$all_video = Video::orderby('video_id','desc')->paginate(6); 

		return view('pages.video.show_video')->with(compact('slider','cate_product','brand_product','all_video','meta_desc','meta_keywords','meta_title','url_canonical', 'all_category_post'));	

	}

	public function watch_video(Request $request){
		$video_id = $request->video_id;
		$video = Video::find($video_id);
		$output['video_title'] = $video->video_title;
		// $output['video_link'] = '<iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$video->video_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

		// $output['video_link'] = '<div id="my_yt_video" class="vlite-js" data-youtube-id="'.$video->video_link.'"></div>';

		$output['video_link'] = '<video id="my_yt_video" 
					       class="vlite-js" 
					       data-youtube-id="'.$video->video_link.'">
					</video>';


		echo json_encode($output);
	}


}
