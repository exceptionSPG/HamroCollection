<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// require the composer autoloader.
require '../vendor/autoload.php';

use Cixware\Esewa\Client;
use Gloudemans\Shoppingcart\Facades\Cart;

class EsewaController extends Controller
{
    //
    public function eSewaOrder(Request $request)
    {

        // init client for development
        $esewa = new Client([
            'success_url' => url('/user/success'), // callback url for success
            'failure_url' => url('/user/failure'), // callback url for failure
        ]);

        //data received from post method
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }


        //Data for esewa payment
        $pid = uniqid();

        $tax_amount = Cart::tax();

        $ta_without_tax = $total_amount - $tax_amount;

        $esewa->process($pid, $ta_without_tax, $tax_amount, 0, 0);



        $status = $esewa->verify('R101', $pid, $total_amount);
        if ($status->verified) {
            // verification successful
            //store in db

            dd($status);

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

                //'payment_type' => $charge->payment_method,
                'payment_method' => 'esewa',
                //'transaction_id' => $charge->balance_transaction,
                'currency' => 'npr',
                'amount' => $total_amount,
                'order_number' => $pid,
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
                'payment_method' => 'eSewa',

            ];
            Mail::to($request->email)->send(new OrderMail($data));
            /*****************************END: SEND mail */

            if (session()->has('coupon')) {
                session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
            }
            Cart::destroy();
        }
    }

    public function esewaSuccess()
    {


        $notification = array(
            'message' => 'Your Order Placed Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('my.orders')->with($notification);
    }

    public function esewaFailure()
    {

        $notification = array(
            'message' => 'Your Payment failed.',
            'alert-type' => 'error',

        );

        return redirect()->route('checkout')->with($notification);
    }
}
