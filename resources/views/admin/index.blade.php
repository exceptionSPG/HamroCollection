@extends('admin.admin_master')
@section('admin')
@php

$date = date('d F Y');
$today = App\Models\Order::where('order_date',$date)->sum('amount');

$month = date('F');
$monthData = App\Models\Order::where('order_month',$month)->sum('amount');


$year = date('Y');
$yearData = App\Models\Order::where('order_year',$year)->sum('amount');

$pendings = App\Models\Order::where('status', 'Pending')->where('esewa_status', '!=', 0)->orderBy('id', 'DESC')->get();
$pendingCount = count($pendings);

$sumPending = App\Models\Order::where('status', 'Pending')->sum('amount');
$order = (auth()->guard('admin')->user()->orders == 1);

@endphp

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Today's Sale</p>
                            <h3 class="text-white mb-0 font-weight-500">Rs.{{$today}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly Sale</p>
                            <h3 class="text-white mb-0 font-weight-500">Rs.{{$monthData}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Yearly Sale</p>
                            <h3 class="text-white mb-0 font-weight-500">Rs.{{$yearData}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <a href="{{$order == true ? route('pending.orders') : '#'}} ">
                        <div class="box-body">
                            <div class="icon bg-danger-light rounded w-60 h-60">
                                <i class="text-danger mr-0 font-size-24 mdi mdi-clock-end"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Pending Orders</p>
                                <h3 class="text-white mb-0 font-weight-500">{{$pendingCount}} </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>




            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Recent Pending Orders
                            <!-- <small class="subtitle">More than 400+ new members</small> -->
                        </h4>
                    </div>




                    <div class="box-body">

                        @if($order == true)
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">Date</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Invoice</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Amount</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">Payment type</span></th>
                                        <!-- <th style="min-width: 130px"><span class="text-fade">status</span></th> -->
                                        <th style="min-width: 120px">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($pendings as $item)
                                    <tr>

                                        <td class="pl-0 py-8">
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </span>

                                        </td>


                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                {{$item->invoice_number}}
                                            </span>

                                        </td>


                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                Rs.{{$item->amount}}
                                            </span>

                                        </td>


                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                {{$item->payment_method}}
                                            </span>

                                        </td>


                                        <!-- <td>
                                            <span class="badge badge-primary-light badge-lg">Approved</span>
                                        </td> -->


                                        <td class="text-right">
                                            <a href="{{route('pending.order.details',$item->id)}}" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-approval"></span></a>
                                            <!-- <a href="#" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a> -->
                                        </td>


                                    </tr>


                                    @endforeach


                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td> </td>
                                        <td><span class="waves-effect waves-light btn btn-primary  mx-5 font-weight-600 d-block font-size-16">Total:</span></td>
                                        <td><span class="waves-effect waves-light btn btn-info font-bold mx-5">
                                                Rs. {{$sumPending}}
                                            </span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        @else
                        <div class="box-header">
                            <h3 class="box-title text-center text-danger flex-column">
                                You have No privilege to view Orders.
                                <!-- <small class="subtitle">More than 400+ new members</small> -->
                            </h3>
                        </div>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection