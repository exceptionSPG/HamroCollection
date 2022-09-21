<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CashController extends Controller
{
    //CashOrder

    public function CashOrder(Request $request)
    {
        // coupon coupon_name coupon_discount discount_amount total_amount
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }


        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'municipal_id' => $request->municipal_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'ward_no' => $request->ward_no,


            'payment_method' => 'cash',

            'currency' => 'npr',
            'amount' => $total_amount,

            'invoice_number' => 'HC' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            // 'confirmed_date' => $charge->payment_method,
            // 'processing_date' => $charge->payment_method,
            // 'picked_date' => $charge->payment_method,
            // 'shipped_date' => $charge->payment_method,
            // 'delivery_date' => $charge->payment_method,
            // 'cancel_date' => $charge->payment_method,
            // 'return_date' => $charge->payment_method,
            // 'return_reason' => $charge->payment_method,
            'esewa_status' => 2,
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        //inserting into OrderItem table
        // order_id	product_id	color	size	qty	price	created_at	
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        /*****************************START: SEND mail */
        //Data to mail
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $request->name,
            'email' => $request->email,
            'payment_method' => 'Cash On Delivery',

        ];
        Mail::to($request->email)->send(new OrderMail($data));
        /*****************************END: SEND mail */




        if (session()->has('coupon')) {
            session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
        }
        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Placed Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('dashboard')->with($notification);
    } //end method
}
