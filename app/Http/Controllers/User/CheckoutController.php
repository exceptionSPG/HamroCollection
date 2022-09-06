<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipMunicipality;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //DistrictGetAjax
    public function DistrictGetAjax($province_id)
    {
        $districts = ShipDistrict::where('province_id', $province_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    } //end method 

    public function MunicipalsGetAjax($district_id)
    {
        $municipals = ShipMunicipality::where('district_id', $district_id)->orderBy('municipal_name', 'ASC')->get();
        return json_encode($municipals);
    } //end method MunicipalsGetAjax CheckoutStore

    public function CheckoutStore(Request $request)
    {

        $validateData = $request->validate([
            'province_id' => 'required',
            'district_id' => 'required',
            'municipal_id' => 'required',
            'notes' => 'required',
            'payment_method' => 'required',

        ], [
            'province_id.required' => 'Please select Province.',
            'district_id.required' => 'Please select District.',
            'municipal_id.required' => 'Please select Municipality.',
            'notes.required' => 'Please write precise location.',
            'payment_method.required' => 'Please Select a Payment Method.',
        ]);

        //id	order_id	province_id	district_id	municipal_id	shipping_name	shipping_email	shipping_phone	post_code	notes

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $data['province_id'] = $request->shipping_name;
        $data['district_id'] = $request->district_id;
        $data['municipal_id'] = $request->municipal_id;

        if ($request->payment_method == 'khalti') {
            return view('frontend.payment.khalti', compact('data'));
        } elseif ($request->payment_method == 'card') {
            return view('frontend.payment.card', compact('data'));
        } else {


            return 'cash';
        }
    } //end method CheckoutStore
}
