<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    //
    public function MyCart()
    {
        return view('frontend.wishlist.view_mycart');
    } //end method

    public function GetCartProducts()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::totalFloat();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    } //end method //end method CartProductRemove

    //Remove Cart item Start
    public function CartProductRemove($id)
    {
        Cart::remove($id);
        if (session()->has('coupon')) {

            session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
        }


        return response()->json(['success' => 'Product Removed from Cart']);
    } //end method
    //Remove  Cart item END

    //CartIncrement
    public function CartIncrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (session()->has('coupon')) {
            $coupon_name = session()->get('coupon_name');
            $coupon = Coupon::where('coupon_name', $coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();
            // coupon coupon_name coupon_discount discount_amount total_amount

            $ca = $coupon->coupon_discount;
            session()->put(
                'coupon',
                'coupon xa hai'
            );
            session()->put(
                'coupon_name',
                $coupon->coupon_name,
            );
            session()->put(
                'coupon_discount',
                $ca
            );
            session()->put(
                'discount_amount',
                round(Cart::totalFloat() * $ca / 100)
            );

            session()->put(
                'total_amount',
                round(Cart::totalFloat() - Cart::totalFloat() * $ca / 100),
            );


            // session([
            //     'coupon' => 'coupon xa hai',
            //     'coupon_name' => $coupon->coupon_name,
            //     'coupon_discount' => $coupon->coupon_discount,
            //     'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
            //     'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),

            // ]);
        }

        return response()->json(['increment']);
    } //end method CartDecrement

    //CartDecrement
    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (session()->has('coupon')) {
            $coupon_name = session()->get('coupon_name');
            $coupon = Coupon::where('coupon_name', $coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();

            $ca = $coupon->coupon_discount;
            session()->put(
                'coupon',
                'coupon xa hai'
            );
            session()->put(
                'coupon_name',
                $coupon->coupon_name,
            );
            session()->put(
                'coupon_discount',
                $ca
            );
            session()->put(
                'discount_amount',
                round(Cart::totalFloat() * $ca / 100)
            );

            session()->put(
                'total_amount',
                round(Cart::totalFloat() - Cart::totalFloat() * $ca / 100),
            );


            // session([
            //     'coupon' => 'coupon xa hai',
            //     'coupon_name' => $coupon->coupon_name,
            //     'coupon_discount' => $coupon->coupon_discount,
            //     'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
            //     'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),

            // ]);
        }
        return response()->json(['Decrement']);
    } //end method 
}
