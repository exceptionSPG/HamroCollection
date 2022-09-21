@extends('frontend.main_master')
@section('title')
Home - HamroCollection
@endsection
@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                @include('frontend.common.vertical_menu')
                <!-- {{ asset('frontend/') }} -->
                <!-- ============================================== HOT DEALS ============================================== -->
                @include('frontend.common.hot_deals')
                <!-- ============================================== HOT DEALS: END ============================================== -->

                <!-- ============================================== SPECIAL OFFER ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">Special Offer</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

                            <!-- @foreach($special_offer as $product) This loop is for slider jasto dekhauna pryo vane-->
                            <div class="item">
                                <div class="products special-product">
                                    @foreach($special_offer as $product)

                                    <div class="product">
                                        <div class="product-micro">

                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">

                                                    <div class="product-info ">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                                        @php

                                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                                        @endphp
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                @if($average == 0)
                                                                No Rating Yet
                                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                @endif



                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="#" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                                            </div>
                                                        </div><!-- /.rating-reviews -->

                                                        <div class="description"></div>

                                                        <div class="product-price">@if($product->discount_price == NULL)
                                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                                            @else

                                                            <span class="price">

                                                                Rs. {{ $product->discount_price }}

                                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->

                                    </div>
                                    @endforeach


                                </div>
                            </div>
                            <!-- @endforeach -->

                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->

                @include('frontend.common.product_tags')

                <!-- ============================================== SPECIAL DEALS ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">Special Deals</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">


                            <div class="item">
                                <div class="products special-product">
                                    @foreach($specialDeals as $product)

                                    <div class="product">

                                        <div class="product-micro">

                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info ">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                                        @php

                                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                                        @endphp
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                @if($average == 0)
                                                                No Rating Yet
                                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                @endif



                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                                            </div>
                                                        </div><!-- /.rating-reviews -->

                                                        <div class="description"></div>

                                                        <div class="product-price">@if($product->discount_price == NULL)
                                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                                            @else

                                                            <span class="price">

                                                                Rs. {{ $product->discount_price }}

                                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->

                                    </div>

                                    @endforeach

                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->

                <!-- ============================================== Testimonials============================================== -->
                <!--Testimonials can be inserted from common -->
                <!-- ============================================== Testimonials: END ============================================== -->

            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                        @foreach($sliders as $slider)

                        <div class="item" style="background-image: url({{asset($slider->slider_image) }});">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <!-- <div class="slider-header fadeInDown-1">Top Brands</div> -->
                                    <div class="big-text fadeInDown-1"> {{ $slider->title }} </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                                    <!-- <div class="button-holder fadeInDown-3"> <a href="" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div> -->
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                        @endforeach




                    </div>
                    <!-- /.owl-carousel -->
                </div>

                <!-- ========================================= SECTION – HERO : END ========================================= -->

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">money back</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">30 Days Money Back Guarantee</h6><br>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">free shipping</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Shipping within Kathmandu Valley</h6>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Special Sale</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Extra off With our Coupon System </h6>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.info-boxes-inner -->

                </div>
                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">New Products</h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                            @foreach($categories as $category)
                            <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{ $category->category_name_en }}</a></li>
                            @endforeach

                            <!-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                            <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>
                             -->
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>
                    <div class="tab-content outer-top-xs">



                        <div class="tab-pane in active" id="all">

                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    @foreach($products as $product)
                                    <div class="item item-carousel">

                                        <div class="products">
                                            <div class="product">

                                                <div class="product-image">
                                                    <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/$product->selling_price)*100;
                                                    @endphp
                                                    <div>
                                                        @if($product->discount_price == NULL)
                                                        <div class="tag new"><span>new</span></div>
                                                        @else
                                                        <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                        @endif
                                                    </div>



                                                </div>
                                                <!-- /.product-image -->


                                                <div class="product-info ">
                                                    <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>


                                                    @php

                                                    $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            @if($average == 0)
                                                            No Rating Yet
                                                            @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>

                                                                        @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            @endif



                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                                        </div>
                                                    </div><!-- /.rating-reviews -->

                                                    <div class="description"></div>

                                                    <div class="product-price">@if($product->discount_price == NULL)
                                                        <span class="price">Rs. {{ $product->selling_price }}</span>
                                                        @else

                                                        <span class="price">

                                                            Rs. {{ $product->discount_price }}

                                                        </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li class="add-cart-button btn-group">

                                                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>



                                                            <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>


                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    @endforeach
                                    <!-- End all product foreach -->


                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->

                        @foreach($categories as $category)
                        <div class="tab-pane" id="category{{ $category->id }}">

                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    @php
                                    $catwise_products = App\Models\Product::where('category_id',$category->id)->where('status',1)->orderBy('id','DESC')->get();
                                    @endphp

                                    @forelse($catwise_products as $product)
                                    <div class="item item-carousel">

                                        <div class="products">
                                            <div class="product">

                                                <div class="product-image">
                                                    <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/$product->selling_price)*100;
                                                    @endphp
                                                    <div>
                                                        @if($product->discount_price == NULL)
                                                        <div class="tag new"><span>new</span></div>
                                                        @else
                                                        <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->


                                                <div class="product-info ">
                                                    <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                                    @php

                                                    $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            @if($average == 0)
                                                            No Rating Yet
                                                            @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>

                                                                        @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            @endif



                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                                        </div>
                                                    </div><!-- /.rating-reviews -->

                                                    <div class="description"></div>

                                                    <div class="product-price">@if($product->discount_price == NULL)
                                                        <span class="price">Rs. {{ $product->selling_price }}</span>
                                                        @else

                                                        <span class="price">

                                                            Rs. {{ $product->discount_price }}

                                                        </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li class="add-cart-button btn-group">

                                                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>



                                                            <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>


                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->

                                    @empty

                                    <h5 class="text-danger">No Product Found</h5>


                                    @endforelse
                                    <!-- End all product foreach -->


                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->

                        @endforeach
                        <!-- End tab pane foreach -->





                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/home-banner1.jpg') }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/home-banner2.jpg') }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Featured products</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach($featured as $product)
                        <div class="item item-carousel">

                            <div class="products">
                                <div class="product">

                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        <div>
                                            @if($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>



                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                        @php

                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">

                                                @if($average == 0)
                                                No Rating Yet
                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @endif



                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                            </div>
                                        </div><!-- /.rating-reviews -->

                                        <div class="description"></div>

                                        <div class="product-price">@if($product->discount_price == NULL)
                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                            @else

                                            <span class="price">

                                                Rs. {{ $product->discount_price }}

                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">

                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>



                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>






                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->



                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/home-banner.jpg') }}" alt=""> </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->


                <!-- ============================================== Redommendation vaneko jastai PRODUCTS Skip Product ) started============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">@if(session()->get('language') == 'nepali'){{ $skip_category_0->category_name_nep }} @else {{ $skip_category_0->category_name_en }} @endif</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach($skip_product_0 as $product)
                        <div class="item item-carousel">

                            <div class="products">
                                <div class="product">

                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        <div>
                                            @if($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>



                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                        @php

                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">

                                                @if($average == 0)
                                                No Rating Yet
                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @endif



                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                            </div>
                                        </div><!-- /.rating-reviews -->

                                        <div class="description"></div>

                                        <div class="product-price">@if($product->discount_price == NULL)
                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                            @else

                                            <span class="price">

                                                Rs. {{ $product->discount_price }}

                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">


                                                <li class="add-cart-button btn-group">

                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>



                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>


                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== Recommendation vaneko jastai PRODUCTS : END =============-->


                <!-- ============================================== Redommendation vaneko jastai PRODUCTS Skip Product1 started============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">@if(session()->get('language') == 'nepali'){{ $skip_category_1->category_name_nep }} @else {{ $skip_category_1->category_name_en }} @endif</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach($skip_product_1 as $product)
                        <div class="item item-carousel">

                            <div class="products">
                                <div class="product">

                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        <div>
                                            @if($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>



                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                        @php

                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">

                                                @if($average == 0)
                                                No Rating Yet
                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @endif



                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                            </div>
                                        </div><!-- /.rating-reviews -->

                                        <div class="description"></div>

                                        <div class="product-price">@if($product->discount_price == NULL)
                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                            @else

                                            <span class="price">

                                                Rs. {{ $product->discount_price }}

                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">

                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>



                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>


                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== Recommendation vaneko jastai Skip Product 1 : END =============-->


                <!-- ============================================== BEST SELLER / Trending Products ============================================== -->

                <!--  Best seller lai include garna milxa 'frontend.common.best_seller') -->

                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Trending products</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach($trending as $item)

                        @php
                        $product = App\Models\Product::findOrFail($item);
                        @endphp

                        <div class="item item-carousel">

                            <div class="products">
                                <div class="product">

                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        <div>
                                            @if($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>



                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                        @php

                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">

                                                @if($average == 0)
                                                No Rating Yet
                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @endif



                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                            </div>
                                        </div><!-- /.rating-reviews -->

                                        <div class="description"></div>

                                        <div class="product-price">@if($product->discount_price == NULL)
                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                            @else

                                            <span class="price">

                                                Rs. {{ $product->discount_price }}

                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">

                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>



                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>






                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>

                        <!-- /.item -->

                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->




                <!-- ============================================== Redommendation vaneko jastai PRODUCTS Skip Brand1 started============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">@if(session()->get('language') == 'nepali'){{ $skip_brand_1->brand_name_nep }} Brand @else {{ $skip_brand_1->brand_name_en }} Brand @endif</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

                        @foreach($skip_brand_product_1 as $product)
                        <div class="item item-carousel">

                            <div class="products">
                                <div class="product">

                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        <div>
                                            @if($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>



                                    </div>
                                    <!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                                        @php

                                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">

                                                @if($average == 0)
                                                No Rating Yet
                                                @elseif($average == 1 || $average < 2) <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($average == 2 || $average < 3) <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        @elseif($average == 3 || $average < 4) <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

                                                            @elseif($average == 4 || $average < 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($average == 5 || $average > 5) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @endif



                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                            </div>
                                        </div><!-- /.rating-reviews -->

                                        <div class="description"></div>

                                        <div class="product-price">@if($product->discount_price == NULL)
                                            <span class="price">Rs. {{ $product->selling_price }}</span>
                                            @else

                                            <span class="price">

                                                Rs. {{ $product->discount_price }}

                                            </span> <span class="price-before-discount">Rs. {{ $product->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">

                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>



                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== Recommendation vaneko jastai Skip Product 1 : END =============-->


                <!-- ============================================== BLOG SLIDER ============================================== -->
                <!-- Blog -->
                @include('frontend.common.blogs')
                <!-- /.section -->
                <!-- ============================================== BLOG SLIDER : END ============================================== -->



                <!-- ============================================== New Arrival PRODUCTS ============================================== -->
                <!-- common bata new arrival insert garna milxa -->
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->



            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->

@endsection