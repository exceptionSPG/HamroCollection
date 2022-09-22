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
        //Data for esewa payment
        $pid = uniqid();
        //data received from post method
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }

        //Store in Database

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

            'esewa_status' => 'unverified',
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


        // init client for development
        $esewa = new Client([
            'success_url' => url('/user/success'), // callback url for success
            'failure_url' => url('/user/failure'), // callback url for failure
        ]);






        $tax_amount = 0.13 * $total_amount;

        $ta_without_tax = $total_amount - $tax_amount;

        $esewa->process($pid, $ta_without_tax, $tax_amount, 0, 0);
    }


    public function esewaSuccess()
    {
        $refId = $_GET['refId'];
        $pid = $_GET['oid'];
        $amt = $_GET['amt'];

        $order = Order::where('order_number', $pid)->where('payment_method', 'esewa')->first();

        $id = $order->id;


        $esewa = new Client([
            'success_url' => url('/user/success'), // callback url for success
            'failure_url' => url('/user/failure'), // callback url for failure
        ]);

        $status = $esewa->verify($refId, $pid, $amt);

        if ($order) {
            if ($status->verified) {
                // verification successful
                //update esewa_status from unverified to verified.


                $up_status = Order::findOrFail($id)->update([
                    'esewa_status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($up_status) {
                    //successfully updated, send email as order placed.
                    /*****************************START: SEND mail */
                    //Data to mail

                    $data = [
                        'invoice_no' => $order->invoice_number,
                        'amount' => $amt,
                        'name' => $order->name,
                        'email' => $order->email,
                        'payment_method' => 'eSewa',

                    ];
                    Mail::to($order->email)->send(new OrderMail($data));
                    /*****************************END: SEND mail */

                    if (session()->has('coupon')) {
                        session()->forget(['coupon', 'coupon_discount', 'coupon_name', 'discount_amount', 'total_amount']);
                    }
                    Cart::destroy();

                    $notification = array(
                        'message' => 'Your Order Placed Successfully.',
                        'alert-type' => 'success',

                    );
                    return redirect()->route('my.orders')->with($notification);
                }
                $notification = array(
                    'message' => 'Some Internal error occured.Contact Admin. ',
                    'alert-type' => 'error',

                );

                return redirect()->route('dashboard')->with($notification);
            } else {



                $notification = array(
                    'message' => 'Your Payment couldnot be verified.\nPlease Contact us for further query.',
                    'alert-type' => 'error',

                );

                return redirect()->route('checkout')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Some Internal error occured. ',
                'alert-type' => 'error',

            );

            return redirect()->route('checkout')->with($notification);
        }
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
