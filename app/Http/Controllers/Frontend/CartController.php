<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // AddToCartAjax

    public function AddToCart(Request $request, $product_id)
    {
        //header("Content-Type: application/json", true);
        $product = Product::findOrFail($product_id);

        if ($product->discount_price == NULL) {
            //Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 550, 'options' => ['size' => 'large']]);

            Cart::add([
                'id' => $product_id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json([
                'success' => 'Successfully Added on Your Cart.',

            ]);
        } else {
            //Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 550, 'options' => ['size' => 'large']]);

            Cart::add([
                'id' => $product_id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size
                ],
            ]);
            return response()->json([
                'success' => 'Successfully Added on Your Cart.',
            ]);
        }
    } //end method 

    //Add to Mini Cart section START
    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::totalFloat();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    } //end method
    //Add to Mini Cart section START

    //Remove Mini Cart Start
    public function RemoveMiniCartItem($rowId)
    {

        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed from Cart']);
    } //end method
    //Remove Mini Cart END

    //Add to Wishlist
    public function AddToWishlist($product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();


            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Product Added to Wishlist.']);
            } else {
                return response()->json(['error' => 'Product is already in your Wishlist.']);
            }
        } else {
            return response()->json(['error' => 'At First, Login to your Account.']);
        }
    } //end method



}