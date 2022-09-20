<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Mail\StockMail;
use App\Models\Admin;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StockController extends Controller
{
    //
    public function ProductStock()
    {

        $product_below = Product::where('product_qty', '<', 30)->orderBy('product_qty')->get();
        return view('backend.product.product_stock', compact('product_below'));
    } //end method AllProductStock

    public function AllProductStock()
    {


        $products = Product::orderBy('product_qty')->get();

        return view('backend.product.all_product_stock', compact('products'));
    } //end method 

    public function UpdateStock(Request $request)
    {

        $update = Product::findOrFail($request->itemId)->update([
            'product_qty' => $request->quantity,
            'updated_at' => Carbon::now(),
        ]);
        if ($update) {
            $notification = array(
                'message' => 'Quantity updated successfully.',
                'alert-type' => 'success',

            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Quantity couldnot be updated rightnow.',
                'alert-type' => 'error',

            );

            return redirect()->back()->with($notification);
        }
    } //end method SendStockMail

    public function SendStockMail()
    {
        $product_below = Product::where('product_qty', '<', 30)->orderBy('product_qty')->get();

        $admins = Admin::where('product', 1)->where('stock', 1)->pluck('email')->toArray();

        /*****************************START: SEND mail */
        //Data to mail
        $allData = [];
        foreach ($product_below as $product) {
            $allData[$product->id] = [

                'product_name' => $product->product_name_en,
                'quantity' => $product->product_qty,
            ];
        }

        //dd($allData);
        foreach ($admins as $admin) {
            Mail::to($admin)->send(new StockMail($allData));
        }
        /*****************************END: SEND mail */


        $notification = array(
            'message' => 'Mail Sent successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    }
}
