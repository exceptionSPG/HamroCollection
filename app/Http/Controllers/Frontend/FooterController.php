<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    //
    public function AboutUs()
    {
        return view('frontend.footer.aboutus');
    }

    public function BankDetails()
    {
        return view('frontend.footer.bankdetails');
    } //end method 

    public function ReturnPolicy()
    {
        return view('frontend.footer.returnpolicy');
    } //end method ReturnPolicy

    public function RefundPolicy()
    {
        return view('frontend.footer.refundpolicy');
    } //end method ReturnPolicy
}
