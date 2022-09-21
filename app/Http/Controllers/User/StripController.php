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
use Stripe\Issuing\Card;

class StripController extends Controller
{
    //StripOrder
    public function StripOrder(Request $request)
    {
        // coupon coupon_name coupon_discount discount_amount total_amount
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51LeubbKClkSrZJTRYgjNGAyXlsGckeJfJ48t724RGI30NbGqys0dSEC29B4fxfOVxvoaeiFNvzxl7ItRFujwPlrF00PbcBJ4Wx');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'npr',
            'description' => 'HamroCollection ',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);
        //dd($charge);

        //storing on Order table
        /*  ORDER DB: user_id	province_id	district_id	municipal_id	name	email	phone	post_code	ward_no	payment_type
        payment_method	transaction_id	currency	amount	order_number	invoice_number	order_date	order_month	order_year	confirmed_date	processing_date	picked_date	shipped_date	delivery_date	cancel_date	return_date	return_reason	status */

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

            'payment_type' => $charge->payment_method,
            'payment_method' => 'stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
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
            'payment_method' => 'Stripe',

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
        return redirect()->route('my.orders')->with($notification);
    } //end method
}
