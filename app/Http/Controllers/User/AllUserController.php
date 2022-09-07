<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    //
    public function MyOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.user.orders', compact('orders'));
    } //end method

    //
    public function OrderDetails($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->with('province', 'district', 'municipal', 'user')->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order_details', compact('order', 'orderItem'));
    } //end method
}
