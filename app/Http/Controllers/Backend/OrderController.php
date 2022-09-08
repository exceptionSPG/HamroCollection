<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmedMail;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function PendingOrders()
    {
        $pendings = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('pendings'));
    } //end method

    public function PendingOrderDetails($order_id)
    {
        $order = Order::with('province', 'district', 'municipal', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_order_details', compact('order', 'orderItem'));
    } //end method

    public function ConfirmedOrders()
    {
        $confirms = Order::where('status', 'Confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('confirms'));
    } //end method 

    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'Processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    } //end method ProcessingOrders 

    public function PickedOrders()
    {
        $orders = Order::where('status', 'Picked')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked_orders', compact('orders'));
    } //end method PickedOrders 

    public function ShippedOrders()
    {
        $orders = Order::where('status', 'Shipped')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped_orders', compact('orders'));
    } //end method ShippedOrders 

    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'Delivered')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    } //end method CanceledOrders 


    public function CanceledOrders()
    {
        $orders = Order::where('status', 'Canceled')->orderBy('id', 'DESC')->get();
        return view('backend.orders.canceled_orders', compact('orders'));
    } //end method  PendingToConfirmed

    public function PendingToConfirmed($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Confirmed',
        ]);

        /*****************************START: SEND mail */
        //Data to mail
        // coupon coupon_name coupon_discount discount_amount total_amount
        // if (session()->has('coupon')) {
        //     $total_amount = session()->get('total_amount');
        // } else {
        //     $total_amount = Cart::totalFloat();
        // }
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice' => $invoice,
            'message' => 'Your order is Confirmed. It will reach to you soon.',
            'amount' => $invoice->amount,


        ];
        Mail::to($invoice->email)->send(new ConfirmedMail($data));
        /*****************************END: SEND mail */

        $notification = array(
            'message' => 'Order Confirmed Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('pending.orders')->with($notification);
    } //end method 

    public function ConfirmedToProcessing($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Processing',
        ]);

        /*****************************START: SEND mail 
        //Data to mail
        // coupon coupon_name coupon_discount discount_amount total_amount
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'payment_method' => $invoice->payment_method,

        ];
        Mail::to($invoice->email)->send(new ConfirmedMail($invoice));
        /*****************************END: SEND mail */

        $notification = array(
            'message' => 'Order updated to Processing Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('confirmed.orders')->with($notification);
    } //end method ConfirmedToProcessing ProcessingToPicked



    public function ProcessingToPicked($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Picked',
        ]);

        /*****************************START: SEND mail */
        //Data to mail
        // coupon coupon_name coupon_discount discount_amount total_amount
        /* if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }
         $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'payment_method' => $invoice->payment_method,

        ]; */
        //Mail::to($invoice->email)->send(new ConfirmedMail($invoice));
        /*****************************END: SEND mail */

        $notification = array(
            'message' => 'Order updated to Picked Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('processing.orders')->with($notification);
    } //end method ProcessingToPicked  PickedToShipped



    public function PickedToShipped($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Shipped',
        ]);

        /*****************************START: SEND mail */
        //Data to mail
        // coupon coupon_name coupon_discount discount_amount total_amount
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice' => $invoice,
            'message' => 'Your Order is on the way. We just shipped it.',
            //'amount' => $total_amount,
        ];
        Mail::to($invoice->email)->send(new ConfirmedMail($data));
        /*****************************END: SEND mail */

        $notification = array(
            'message' => 'Order updated to Shipped Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('picked.orders')->with($notification);
    } //end method PickedToShipped   ShippedToDelivered




    public function ShippedToDelivered($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
        ]);

        /*****************************START: SEND mail */
        //Data to mail
        // coupon coupon_name coupon_discount discount_amount total_amount
        if (session()->has('coupon')) {
            $total_amount = session()->get('total_amount');
        } else {
            $total_amount = Cart::totalFloat();
        }
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice' => $invoice,
            'message' => 'Your order is Delivered. Let we serve you again.',
            'amount' => $total_amount,


        ];
        Mail::to($invoice->email)->send(new ConfirmedMail($data));
        /*****************************END: SEND mail */

        $notification = array(
            'message' => 'Order updated to Delivered Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->route('shipped.orders')->with($notification);
    } //end method ShippedToDelivered    AdminInvoiceDownload

    public function AdminInvoiceDownload($order_id)
    {
        $order = Order::where('id', $order_id)->with('province', 'district', 'municipal', 'user')->first();
        $orderItem = OrderItem::where('order_id', $order_id)->with('product')->orderBy('id', 'DESC')->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('backend.orders.order_invoice', compact('order', 'orderItem'));
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download('Invoice-' . $order->invoice_number . '.pdf');

        // $pdf = Pdf::loadView('pdf.invoice', $order);
        // return $pdf->download('invoice.pdf');
        // return view('frontend.user.order_invoice', compact('order', 'orderItem'));
    } //end method 


}
