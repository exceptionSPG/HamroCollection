<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripController extends Controller
{
    //StripOrder
    public function StripOrder(Request $request)
    {

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51LeubbKClkSrZJTRYgjNGAyXlsGckeJfJ48t724RGI30NbGqys0dSEC29B4fxfOVxvoaeiFNvzxl7ItRFujwPlrF00PbcBJ4Wx');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => 999 * 100,
            'currency' => 'npr',
            'description' => 'HamroCollection ',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);
        dd($charge);
    } //end method
}
