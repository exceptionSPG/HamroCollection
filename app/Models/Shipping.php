<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $guarded = [];
    //order_id province_id district_id municipal_id
    public function province()
    {
        return $this->belongsTo(ShippingProvince::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
    public function municipal()
    {
        return $this->belongsTo(ShipMunicipality::class, 'municipal_id', 'id');
    }
}
