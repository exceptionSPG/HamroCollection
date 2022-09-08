@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">

            @include('frontend.common.user_sidebar')

            <div class="col-md-1">

            </div>
            <!-- Main content area -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for="">Date</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Total</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Payment</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Orders</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="">Action</label>
                                </td>
                            </tr>

                            @foreach($orders as $order)
                            <tr>
                                <td class="col-md-1">
                                    <label for=""> {{$order->order_date }}</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">{{$order->amount }}</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">{{$order->payment_method }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{$order->invoice_number }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">
                                        @if($order->status == 'Pending')
                                        <span class="badge badge-pill badge-warning" style="background: #800080;"> Pending </span>
                                        @elseif($order->status == 'Confirmed')
                                        <span class="badge badge-pill badge-warning" style="background: #0000FF;"> Confirm </span>

                                        @elseif($order->status == 'Processing')
                                        <span class="badge badge-pill badge-warning" style="background: #FFA500;"> Processing </span>

                                        @elseif($order->status == 'Picked')
                                        <span class="badge badge-pill badge-warning" style="background: #808000;"> Picked </span>

                                        @elseif($order->status == 'Shipped')
                                        <span class="badge badge-pill badge-warning" style="background: #808080;"> Shipped </span>

                                        @elseif($order->status == 'Delivered')
                                        <span class="badge badge-pill badge-warning" style="background: #008000;"> Delivered </span>

                                        @if($order->return_order == 1)
                                        <span class="badge badge-pill badge-warning" style="background:red;">Return Requested </span>

                                        @endif

                                        @else
                                        <span class="badge badge-pill badge-warning" style="background: #FF0000;"> Cancel </span>

                                        @endif
                                    </label>
                                </td>
                                <td class="col-md-1">


                                    <a href="{{ url('/user/order_details/'.$order->id) }}" class="btn btn-primary sm" title="View Order"><i class="fa fa-eye"></i>View</a>
                                    <a href="{{ url('/user/invoice-download/'.$order->id) }}" class="btn btn-danger sm" title="Invoice" id="delete"><i class="fa fa-download"></i>Invoice</a>
                                </td>
                            </tr>
                            @endforeach





                        </tbody>
                    </table>
                </div>


            </div>
            <!-- end col md 8 -->

            <div class="col-md-1">

            </div>

        </div>
    </div>
</div>





@endsection