<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShippingProvince;
use App\Models\Wishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // AddToCartAjax

    public function AddToCart(Request $request, $product_id)
    {

        if (session()->has('coupon')) {

            session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
        }
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
    } //end method CouponApply

    public function CouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();
        $msg = "";

        if ($coupon) {

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

            //session()->put('step_1.security', 'yes');
            // session([
            //     'coupon' => 'coupon xa hai',
            //     'coupon_name' => $coupon->coupon_name,
            //     'coupon_discount' => 25,
            //     'discount_amount' => round(Cart::total() * $ca / 100),
            //     'total_amount' => round(Cart::total() - Cart::total() * $ca / 100),

            // ]);
            return response()->json([

                'success' =>  $ca . '% Coupon Applied Successfully ' . $msg,

            ]);
        } else {
            return response()->json([
                'error' => 'Invalid Coupon',

            ]);
        }
    } //end method 

    public function CouponCalculation()
    {
        if (session()->has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon_name'),
                'coupon_discount' => session()->get('coupon_discount'),
                'discount_amount' => session()->get('discount_amount'),
                'total_amount' => session()->get('total_amount'),
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),

            ));
        }
    } //end method CouponCalculation

    public function CouponRemove()
    {
        session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
        return response()->json(['success' => 'Coupon Removed Successfully.']);
    } //end method 


    /* ***********START: CheckoutCreate****************/
    public function CheckoutCreate()
    {
        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::totalFloat();

                $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
                // $districts = ShippingProvince::orderBy('district_name', 'ASC')->get();
                // $districts = ShippingProvince::orderBy('district_name', 'ASC')->get();


                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'provinces'));
            } else {
                $notification = array(
                    'message' => 'Your Cart is empty, Shop some item first.',
                    'alert-type' => 'error',

                );
                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'You need to login first.',
                'alert-type' => 'error',

            );
            return redirect()->route('login')->with($notification);
        }
    }


    /* ***********END: CheckoutCreate****************/
}
