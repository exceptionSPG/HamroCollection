<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        return response()->json(['success' => 'Product Removed from Cart']);
    } //end method
    //Remove  Cart item END

    //CartIncrement
    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json(['increment']);
    } //end method CartDecrement

    //CartDecrement
    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json(['increment']);
    } //end method 
}
