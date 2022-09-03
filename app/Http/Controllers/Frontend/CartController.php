<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


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



}
