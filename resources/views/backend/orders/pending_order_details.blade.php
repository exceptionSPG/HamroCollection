@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full" style="background-color: #DFF6FF;">
    <!-- Content Header (Page header) -->


    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Order Details</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                    </div>

                    <table class="table">
                        <tr>
                            <th>
                                Shipping Name:
                            </th>
                            <th>{{ $order->name }}</th>
                        </tr>
                        <tr>
                            <th>Shipping Phone:</th>
                            <th>{{ $order->phone }}</th>
                        </tr>
                        <tr>
                            <th>Shipping Email:</th>
                            <th>{{ $order->email }}</th>
                        </tr>
                        <tr>
                            <th>Province</th>
                            <th>{{ $order->province->province_name }}</th>
                        </tr>
                        <tr>
                            <th>District</th>
                            <th>{{ $order->district->district_name }}</th>
                        </tr>
                        <tr>
                            <th>Municipality</th>
                            <th>{{ $order->municipal->municipal_name }}</th>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>
                    </table>


                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Order Details</strong> </h4>
                    </div>
                    <table class="table">
                        <tr>
                            <th>
                                User Name:
                            </th>
                            <th>{{ $order->user->name }}</th>
                        </tr>
                        <tr>
                            <th>User email:</th>
                            <th>{{ $order->user->email }}</th>
                        </tr>
                        <tr>
                            <th>Payment Method:</th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>
                        <tr>
                            <th>Invoice: </th>
                            <th class="text-danger">{{ $order->invoice_number }}</th>
                        </tr>
                        <tr>
                            <th>Order Total</th>
                            <th>Rs.{{ $order->amount }}</th>
                        </tr>

                        <tr>
                            <th>Order Status</th>
                            <th><span class="badge badge-pill badge-success " style="background: #418DB9;">{{$order->status }}</span></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                @if($order->status == 'Pending')
                                <a href="{{ route('pending-confirm',$order->id) }}" class="btn btn-success btn-block" id="confirm">Confirm Order</a>
                                @elseif($order->status == 'Confirmed')
                                <a href="{{ route('processing-order',$order->id) }}" class="btn btn-success btn-block" id="processing">Processing Order</a>

                                @elseif($order->status == 'Processing')
                                <a href="{{ route('processing.picked',$order->id) }}" class="btn btn-success btn-block" id="picked">Picked Order</a>
                                @elseif($order->status == 'Picked')
                                <a href="{{ route('picked.shipped',$order->id) }}" class="btn btn-success btn-block" id="shipped">Shipped Order</a>
                                @elseif($order->status == 'Shipped')
                                <a href="{{ route('shipped.delivered',$order->id) }}" class="btn btn-success btn-block" id="delivered">Delivered Order</a>
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="col-md-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Product Details</strong></h4>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="10%">
                                    <label for="">Image</label>
                                </td>
                                <td width="20%">
                                    <label for="">Product Name</label>
                                </td>
                                <td width="20%">
                                    <label for="">Product Code</label>
                                </td>
                                <td width="10%">
                                    <label for="">Color</label>
                                </td>
                                <td width="10%">
                                    <label for="">Size </label>
                                </td>
                                <td width="10%">
                                    <label for="">Quantity </label>
                                </td>
                                <td width="30%">
                                    <label for="">Price </label>
                                </td>
                            </tr>

                            @foreach($orderItem as $item)
                            <tr>
                                <td width="10%">
                                    <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" alt="" height="50px" width="50px"> </label>
                                </td>
                                <td width="20%">
                                    <label for="">{{ $item->product->product_name_en }}</label>
                                </td>
                                <td width="20%">
                                    <label for="">{{ $item->product->product_code }}</label>
                                </td>
                                <td width="10%">
                                    <label for="">{{$item->color }}</label>
                                </td>
                                <td width="10%">
                                    <label for="">{{$item->size }}</label>
                                </td>
                                <td width="10%">
                                    <label for="">{{$item->qty }}</label>
                                </td>
                                <td width="30%">
                                    <label for="">Rs. {{$item->price }} (Rs.{{ $item->price * $item->qty }} )</label>
                                </td>
                            </tr>
                            @endforeach





                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

@endsection