<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //ReportView
    public function ReportView()
    {

        return view('backend.reports.report_view');
    } //end method ReportByDate

    public function ReportByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        $msg = ' Date : ' . $formatDate;

        return view('backend.reports.report_show', compact('orders', 'msg'));
    } //end method ReportByMonth

    public function ReportByMonth(Request $request)
    {
        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year_name)->latest()->get();
        $msg = ' Month: ' . $request->month . ' , ' . $request->year_name;
        return view('backend.reports.report_show', compact('orders', 'msg'));
    } //end method 

    public function ReportByYear(Request $request)
    {
        $orders = Order::where('order_year', $request->year)->latest()->get();
        $msg = ' Year: ' . $request->year;
        return view('backend.reports.report_show', compact('orders', 'msg'));
    } //end method 
}
