@extends('frontend.main_master')
@section('content')

@section('title')
Order Details - HamroCollection
@endsection

<div class="body-content">
    <div class="container">
        <div class="row">

            @include('frontend.common.user_sidebar')

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipping Details</h4>

                    </div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
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

            </div>
            <!-- end col-md-5 -->







            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details</h4>

                    </div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
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
                                <th><span class="badge badge-pill badge-warning" style="background: #418DB9;">{{$order->status }}</span></th>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <!-- end col-md-5 -->


        </div>

        <div class="row">
            <!-- Main content area -->


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Details</h4>

                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for="">Image</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for="">Product Name</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Product Code</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Color</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Size </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Quantity </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Price </label>
                                    </td>
                                </tr>

                                @foreach($orderItem as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" alt="" height="50px" width="50px"> </label>
                                    </td>
                                    <td class=" col-md-3">
                                        <label for="">{{ $item->product->product_name_en }}</label>
                                    </td>
                                    <td class=" col-md-2">
                                        <label for="">{{ $item->product->product_code }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">{{$item->color }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">{{$item->size }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">{{$item->qty }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Rs. {{$item->price }} (Rs.{{ $item->price * $item->qty }} )</label>
                                    </td>
                                </tr>
                                @endforeach





                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- end col md 8 -->

            <!-- <div class="col-md-2">-->
            @if($order->status != 'Delivered')

            @else

            @php
            $ret_order = App\Models\Order::where('id',$order->id)->where('return_reason','=',Null)->first();
            @endphp
            @if($order->return_order == 0)



            <form action="{{ route('return.order',$order->id) }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="label">Order Return Reason:</label><br>
                    <textarea name="return_reason" id="" cols="30" rows="5">Return Rason</textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-danger">Order Return</button>
                    <h4>Know More about our:<a href="{{ route('return-policy') }}"><strong>Return Policy</strong></a></h4>

                </div>

            </form>
            @elseif($order->return_order == 1)
            <span class="badge badge-pill badge-warning" style="background: red;">You have sent return request for this product. <a href="{{route('return.orders.list')}}">Check Status Here</a> </span>
            @elseif($order->return_order == 2)
            <h4> Your Return request is:<span class="badge badge-pill badge-success" style="background: green;"> <b>Approved</b> </span></h4>

            @elseif($order->return_order == 3)
            <h4> Your Return request is:<span class="badge badge-pill badge-warning" style="background: red;"> <b>Rejected</b> </span></h4>
            <h4>Know More about our:<a href="{{ route('return-policy') }}"><strong>Return Policy</strong></a></h4>
            @endif
            @endif
            <!-- </div> -->
            <br><br>

        </div>
    </div>
</div>





@endsection