<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{
	public function delivery(request $request)
	{
		$city = City::OrderBy('matp','ASC')->get();
		return view('admin.delivery.add_delivery')->with(compact('city'));
	}

	public function update_delivery(request $request)
	{
		$data = $request->all();
		$fee_ship = Feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
	}

	public function insert_delivery(request $request)
	{
		$data = $request->all();
		$fee_ship = new Feeship();
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
	}

	public function select_feeship()
	{
		$fee = Feeship::OrderBy('fee_id',"DESC")->get();
		$output = '';
		$output .='<div class="table-responsive">
			<table class="table table-bordered">				
				<thead>
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th>
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>
				</thead>
				<tbody>
				';
				foreach($fee as $key => $v_fee){
					$output.='
					<tr>
						<td>'.$v_fee->city->name_thanhpho.'</td>
						<td>'.$v_fee->province->name_quanhuyen.'</td>
						<td>'.$v_fee->wards->name_xaphuong.'</td>
						<td contenteditable data-feeship_id="'.$v_fee->fee_id.'" class="fee_feeship_edit">'.number_format($v_fee->fee_feeship,0,',','.').'</td>
					</tr>
				';
				}

				$output.='</tbody></table></div>
		';
		echo $output;
	}

	public function select_delivery(request $request)
	{
		$data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action']=="city"){
				$select_province = Province::where('matp',$data['ma_id'])->OrderBy('maqh','ASC')->get();
				$output.='<option>---Chọn quận huyện---</option>';
				foreach($select_province as $key => $v_province){
					$output.='<option value="'.$v_province->maqh.'">'.$v_province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = Wards::where('maqh',$data['ma_id'])->OrderBy('xaid','ASC')->get();
				$output.='<option>---Chọn xã phường---</option>';
				foreach($select_wards as $key => $v_wards){
					$output.='<option value="'.$v_wards->xaid.'">'.$v_wards->name_xaphuong.'</option>';
				}
			}
		}
		echo $output;    	
	}
}
