<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipMunicipality;
use App\Models\ShippingProvince;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //
    public function ProvinceView()
    {
        $province = ShippingProvince::orderBy('id', 'DESC')->get();

        return view('backend.ship.province.view_province', compact('province'));
    } //end method 

    // coupon_name	 coupon_discount	coupon_validity
    public function ProvinceStore(Request $request)
    {
        $validateData = $request->validate([
            'province_name' => 'required',


        ], [
            'province_name.required' => 'Province Name is required.',

        ]);


        ShippingProvince::insert([
            'province_name' => $request->province_name,

            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Province Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method 

    public function ProvinceEdit($id)
    {
        $province = ShippingProvince::findOrFail($id);
        return view('backend.ship.province.province_edit', compact('province'));
    } //end method   


    public function ProvinceUpdate(Request $request)
    {


        ShippingProvince::findOrFail($request->id)->update([
            'province_name' => $request->province_name,

            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Province updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.province')->with($notification);
    } //end method  



    public function ProvinceDelete($id)
    {

        ShippingProvince::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Province Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method

    // All methods for District CRUD start

    public function DistrictView()
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $districts = ShipDistrict::with('province')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('provinces', 'districts'));
    } //end method 


    public function DistrictStore(Request $request)
    {
        $validateData = $request->validate([
            'province_id' => 'required',
            'district_name' => 'required',


        ], [
            'province_id.required' => 'Province is required.',
            'district_name.required' => 'District Name is required.',

        ]);


        ShipDistrict::insert([
            'province_id' => $request->province_id,
            'district_name' => $request->district_name,

            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method  


    public function DistrictEdit($id)
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.district_edit', compact('district', 'provinces'));
    } //end method   


    public function DistrictUpdate(Request $request)
    {


        ShipDistrict::findOrFail($request->id)->update([
            'province_id' => $request->province_id,
            'district_name' => $request->district_name,

            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.district')->with($notification);
    } //end method  


    public function DistrictDelete($id)
    {

        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method
    //END District 


    /******** START: Gaupalika ra Nagarpalika haru **********/
    public function MunicipalityView()
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $districts = ShipDistrict::with('province')->orderBy('district_name', 'ASC')->get();
        $munis = ShipMunicipality::with('province', 'district')->orderBy('id', 'DESC')->get();
        return view('backend.ship.munis.view_munis', compact('provinces', 'districts', 'munis'));
    } //end method  



    public function MunicipalStore(Request $request)
    {
        $validateData = $request->validate([
            'province_id' => 'required',
            'district_id' => 'required',
            'municipal_name' => 'required',


        ], [
            'province_id.required' => 'Province Name is required.',
            'district_id.required' => 'District is required.',
            'municipal_name.required' => 'Local State Name is required.',

        ]);


        ShipMunicipality::insert([
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'municipal_name' => $request->municipal_name,

            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Municipality Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method  




    public function MunicipalEdit($id)
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $muni = ShipMunicipality::findOrFail($id);
        return view('backend.ship.munis.munis_edit', compact('districts', 'provinces', 'muni'));
    } //end method   


    public function MunicipalUpdate(Request $request)
    {


        ShipMunicipality::findOrFail($request->id)->update([
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'municipal_name' => $request->municipal_name,

            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Local State updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.municipality')->with($notification);
    } //end method  



    public function MunicipalDelete($id)
    {

        ShipMunicipality::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Local State Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method







    public function GetDistrict($province_id)
    {
        $dists = ShipDistrict::where('province_id', $province_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($dists);
    } //end method  




    /******** END: Gaupalika ra Nagarpalika haru **********/
}
