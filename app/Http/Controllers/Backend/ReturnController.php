<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ReturnMail;
use App\Mail\ReturnStatusMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReturnController extends Controller
{
    //

    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.return_request', compact('orders'));
    } //end method ReturnRequestApprove

    public function ReturnRequestApprove($order_id)
    {
        $update = Order::findOrFail($order_id)->update([
            'return_order' => 2,
        ]);

        // if Success, send mail to user, notifying request is rejected
        if ($update) {
            /*************************START: SEND mail */
            //Data to mail
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice' => $invoice,
                'message' => 'We reviewd you return reason. We apologize for the inconvenience caused. We successfully refund your charges and pick up the product. Thank you for your patience.',


            ];
            Mail::to($invoice->email)->send(new ReturnStatusMail($data));
            /*****************************END: SEND mail */

            $notification = array(
                'message' => 'Return Request Approved Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Return Request couldnot be approved at the moment. Some Database error.',
                'alert-type' => 'error',

            );

            return redirect()->back()->with($notification);
        }
    } //end method

    public function ReturnRequestReject($order_id)
    {
        $update = Order::findOrFail($order_id)->update([
            'return_order' => 3,
        ]);

        // if Success, send mail to user, notifying request is rejected
        if ($update) {
            /*************************START: SEND mail */
            //Data to mail
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice' => $invoice,
                'message' => 'We reviewd you return reason: ' . $invoice->return_reason . ' We are sorry to inform you that, this doesnot comply with our return policy. We apologize for the inconvenience caused. Thank you for your understanding. We love to serve you again.',


            ];
            Mail::to($invoice->email)->send(new ReturnStatusMail($data));
            /*****************************END: SEND mail */

            $notification = array(
                'message' => 'Return Request Rejected Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Return Request couldnot be rejected at the moment. Some Database error.',
                'alert-type' => 'error',

            );

            return redirect()->back()->with($notification);
        }
    } //end method 

    public function AllReturnRequest()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.approved_return_request', compact('orders'));
    } //end method RejectedReturnRequest

    public function RejectedReturnRequest()
    {
        $orders = Order::where('return_order', 3)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.rejected_return_request', compact('orders'));
    } //end method RejectedReturnRequest

}
