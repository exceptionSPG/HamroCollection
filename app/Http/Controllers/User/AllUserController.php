<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ReturnMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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


    //ReturnOrder

    public function ReturnOrder(Request $request, $order_id)
    {

        $update = Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        if ($update) {
            /*****************************START: SEND mail */
            //Data to mail
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice' => $invoice,
                'message' => 'We received your return order.',


            ];
            Mail::to($invoice->email)->send(new ReturnMail($data));
            /*****************************END: SEND mail */

            $notification = array(
                'message' => 'Return Request Sent Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->route('return.orders.list')->with($notification);
        } else {
            $notification = array(
                'message' => 'Return Request couldnot be sent at the moment. Try again later.',
                'alert-type' => 'error',

            );

            return redirect()->route('return.orders.list')->with($notification);
        }
    } //end method


    public function ReturnOrdersList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();

        return view('frontend.user.return_order_view', compact('orders'));
    } //end method 

    public function CancelOrdersList()
    {
        $orders = Order::where('user_id', Auth::id())->where('status', '=', 'Canceled')->orderBy('id', 'DESC')->get();

        return view('frontend.user.cancel_orders_view', compact('orders'));
    } //end method CancelOrdersList

}
