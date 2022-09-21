@extends('frontend.main_master')
@section('title')
Refund Policy - HamroCollection
@endsection
@section('content')
@php
$site = App\Models\SiteSetting::find(1);
@endphp

<!-- <div class="container">
    <h3>
        We are on the mission of making customer's living easy; in everyway possible; all across Nepal.
    </h3>
    <br><br>
    <h5 style="letter-spacing: 1px;">
        You may open your internet browser (eg: Mozilla, Chrome, Safari etc.) and type www.Hamrocollection.com; you will reach our ecommerce website where you can browse through thousands of products and order/buy online. Or you can download our mobile app for Android & iOS in your smartphones and browse through hundreds of brands to shop online in Nepal.
    </h5>

    <h5 style="letter-spacing: 1px;">
        At Hamrocollection.com, you can shop all kinds of products. We have abundance of categories such as Jersey, T-shirt, Sunglasses, Jacket, Pant, Shoes etc. Till date, Hamrocollection.com has served 1000s of satisfied customers; and so ensuring high level of loyalty from those valued customers. We, at Hamrocollection.com, ensure timely delivery of products to your homes.
    </h5>
    <div class="row">
        <div class="col-6">
            <h1>Image</h1>
            <img src="{{ asset('upload/footer/citiesthuloimg.png') }}" style="width:40% ; height:40% ;" />
        </div>
        <div class="col-6">
            <h1>Image</h1>
            <img src="{{ asset('upload/footer/citiesthuloimg.png') }}" style="width:40% ; height:40% ;" />
        </div>
    </div>
</div> -->
<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            <div class="row" style="background-color: #FEFBF6 ; padding-top: 15px; padding-bottom: 15px;">
                <div class="col-md-12 x-text">
                    <h3>Refund Policy</h3>
                    <h5>&nbsp; &nbsp;&nbsp;&nbsp;Hamrocollection offers easy and quick Refund on your refund orders.</h5>
                    <div class="heading" style="background-color: red; height:33px;">
                        <h3>&nbsp;When Do You Process A Refund?</h3>
                    </div><br>
                    <h5> &nbsp; &nbsp;&nbsp;&nbsp;Refunds are generally initiated in the following scenarios:</h5><br>
                    <div class="rules" style="text-decoration: solid;">
                        <li>
                            When Prepaid Orders are cancelled by Customer/Hamrcollection before delivery (Please read our <a href="{{ route('return-policy') }}"><strong>Return Policy</strong></a> )
                        </li><br>
                        <li>
                            If Return request for delivered product is approved and accepted.
                        </li><br>
                        <li>
                            If our Delivery Section is unable to deliver the order.

                        </li><br>
                    </div>
                </div>
            </div><!-- /.row -->
            <div class="row" style="background-color: #FEFBF6 ; padding-top: 15px; padding-bottom: 15px;">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">For Any Query,Contact Us</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class="toggle-footer">
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p>{{ $site->company_name}},{{ $site->company_address}}</p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p>{{ $site->phone_one}}<br>
                                        {{ $site->phone_two}}
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body"> <span><a href="mailto:{{ $site->email}}">{{ $site->email}}</a></span> </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">

                </div>
            </div>
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->


@endsection