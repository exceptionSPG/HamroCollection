@extends('frontend.main_master')
@section('title')
About Us - HamroCollection
@endsection
@section('content')


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
@php
$products = App\Models\Product::count();
$users = App\Models\User::count();
$cats = App\Models\Category::count();
@endphp

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            <div class="row" style="background-color: #FEFBF6 ; padding-top: 15px; padding-bottom: 15px;">
                <div class="col-md-4 x-text text-center">
                    <img src="{{ asset('upload/footer/productsalltjulo.png') }}" style="width:20% ; height:20% ; border-radius:50%;" />
                    <h2>{{$products}}+</h2>
                    <h4 style="color: red;">Products</h4>
                </div>
                <div class="col-md-4 x-text text-center">
                    <img src="{{ asset('upload/footer/sellerthuloimg.png') }}" style="width:20% ; height:20% ; border-radius:50%;" />
                    <h2>{{$users}}+</h2>
                    <h4 style="color: red;">Satisfied Customers</h4>
                </div>
                <div class="col-md-4 x-text text-center">
                    <img src="{{ asset('upload/footer/citiesthuloimg.png') }}" style="width:20% ; height:20% ; border-radius:50%;" />
                    <h2>{{$cats}}+</h2>
                    <h4 style="color: red;">Categories</h4>
                </div>
                <div class="col-md-12 x-text text-center">
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
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->


@endsection