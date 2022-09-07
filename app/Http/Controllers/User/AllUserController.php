<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



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
        $orderItem = OrderItem::where('order_id', $order_id)->with('product')->orderBy('id', 'DESC')->get();
        return view('frontend.user.order_details', compact('order', 'orderItem'));
    } //end method InvoiceDownload

    public function InvoiceDownload($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->with('province', 'district', 'municipal', 'user')->first();
        $orderItem = OrderItem::where('order_id', $order_id)->with('product')->orderBy('id', 'DESC')->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('frontend.user.order_invoice', compact('order', 'orderItem'));
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download('Invoice-' . $order->invoice_number . '.pdf');

        // $pdf = Pdf::loadView('pdf.invoice', $order);
        // return $pdf->download('invoice.pdf');
        // return view('frontend.user.order_invoice', compact('order', 'orderItem'));
    } //end method 


}
