<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function ProductStock()
    {


        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));
    } //end method
}
