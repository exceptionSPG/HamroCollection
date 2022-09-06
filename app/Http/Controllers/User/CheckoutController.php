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
        

    }//end method CheckoutStore
}
