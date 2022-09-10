@extends('frontend.main_master')

@section('title')
{{ $product->product_name_en }}
@endsection



@section('content')
<style>
    .checked {
        color: orange;
    }
</style>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">

        <div class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-inner">
                    <ul class="list-inline list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @foreach($breadsubcat as $item)
                        <li class='active'>{{$item->category->category_name_en}}</li>
                        @endforeach
                        @foreach($breadsubcat as $item)
                        <li class='active'>{{ $item->subcategory->subcategory_name_en }}</li>
                        @endforeach

                        @foreach($breadsubcat as $item)
                        <li class='active'>{{$item->sub_subcategory_name_en}}</li>
                        @endforeach

                    </ul>
                </div><!-- /.breadcrumb-inner -->
            </div><!-- /.container -->
        </div><!-- /.breadcrumb -->

        <div class="body-content outer-top-xs">
            <div class='container'>
                <div class='row single-product'>
                    <div class='col-md-3 sidebar'>
                        <div class="sidebar-module-container">
                            <div class="home-banner outer-top-n">

                            </div>



                            <!-- ============================================== HOT DEALS ============================================== -->
                            @include('frontend.common.hot_deals')
                            <!-- ============================================== HOT DEALS: END ============================================== -->

                            <!-- ============================================== NEWSLETTER ============================================== -->

                            <!-- rakhne vaye common ma xa -->
                            <!-- ============================================== NEWSLETTER: END ============================================== -->

                            <!-- ============================================== Testimonials============================================== -->
                            @include('frontend.common.product_tags')
                            <!-- ============================================== Testimonials: END ============================================== -->



                        </div>
                    </div><!-- /.sidebar -->
                    <div class='col-md-9'>
                        <div class="detail-block">
                            <div class="row  wow fadeInUp">

                                <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                    <div class="product-item-holder size-big single-product-gallery small-gallery">

                                        <div id="owl-single-product">

                                            @foreach($multiImg as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name) }}">
                                                    <img class="img-responsive" alt="" src="{{ asset($img->photo_name) }}" data-echo="{{ asset($img->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->



                                            @endforeach


                                        </div><!-- /.single-product-slider -->


                                        <div class="single-product-gallery-thumbs gallery-thumbs">

                                            <div id="owl-single-product-thumbnails">

                                                @foreach($multiImg as $img)

                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name) }}" data-echo="{{ asset($img->photo_name) }}" />
                                                    </a>
                                                </div>
                                                @endforeach




                                            </div><!-- /#owl-single-product-thumbnails -->



                                        </div><!-- /.gallery-thumbs -->

                                    </div><!-- /.single-product-gallery -->
                                </div><!-- /.gallery-holder -->
                                @php

                                $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                @endphp





                                <div class='col-sm-6 col-md-7 product-info-block'>
                                    <div class="product-info">
                                        <h1 class="name" id="pname">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</h1>

                                        <div class="rating-reviews m-t-20">
                                            <div class="row">
                                                <div class="col-sm-3">
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
                                                <div class="col-sm-8">
                                                    <div class="reviews">

                                                        <a href="#" class="lnk">({{ count($reviewCount )}} Reviews)</a>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->
                                        </div><!-- /.rating-reviews -->

                                        <div class="stock-container info-container m-t-10">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="stock-box">
                                                        <span class="label">Availability :</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="stock-box">
                                                        <span class="value">In Stock</span>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->
                                        </div><!-- /.stock-container -->

                                        <div class="description-container m-t-20">
                                            @if(session()->get('language') == 'nepali'){{ $product->short_des_nep }} @else {{ $product->short_des_en }} @endif
                                        </div><!-- /.description-container -->

                                        <div class="price-container info-container m-t-20">
                                            <div class="row">


                                                <div class="col-sm-6">
                                                    <div class="price-box">
                                                        @if($product->discount_price == NULL)
                                                        <span class="price">Rs. {{ $product->selling_price }}</span>
                                                        @else
                                                        <span class="price"> Rs. {{ $product->discount_price }} </span>
                                                        <span class="price-strike">Rs.{{ $product->selling_price }}</span>

                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">


                                                    <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>




                                                </div>

                                            </div><!-- /.row -->
                                        </div><!-- /.price-container -->



                                        <!-- Add Product Color and Size -->

                                        <div class="row">


                                            <div class="col-sm-6">


                                                <div class="form-group">




                                                    <label class="info-title control-label">Choose Color <span></span></label>
                                                    <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color" required="">

                                                        @foreach($product_color_en as $color)
                                                        <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                            </div>
                                            <!-- end col 6 -->

                                            <div class="col-sm-6">
                                                <!-- 'product_color_en', 'product_color_nep', 'product_size_en', 'product_size_nep' -->

                                                @if($product->product_size_en == null)

                                                @else
                                                <div class="form-group">
                                                    <label class="info-title control-label">Choose Size <span></span></label>
                                                    <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size">

                                                        @foreach($product_size_en as $size)
                                                        <option value="{{ $size }}" required="">{{ ucwords($size) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                @endif

                                            </div>
                                            <!-- end col-6 -->
                                        </div>




                                        <!-- End Product Color and Size -->


                                        <div class="quantity-container info-container">
                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <span class="label">Qty :</span>
                                                </div>

                                                <div class="col-sm-2">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <!-- <div class="arrows">
                                                                <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                                <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>


                                                            </div> -->
                                                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

                                                <div class="col-sm-7">
                                                    <button class="btn btn-primary" onclick="addToCart()"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                </div>


                                            </div><!-- /.row -->
                                        </div><!-- /.quantity-container -->



                                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                        <div class="addthis_inline_share_toolbox"></div>






                                    </div><!-- /.product-info -->
                                </div><!-- /.col-sm-7 -->
                            </div><!-- /.row -->
                        </div>

                        <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                        <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                        <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                        <!-- <li><a data-toggle="tab" href="#tags">TAGS</a></li> -->
                                    </ul><!-- /.nav-tabs #product-tabs -->
                                </div>
                                <div class="col-sm-9">

                                    <div class="tab-content">

                                        <div id="description" class="tab-pane in active">
                                            <div class="product-tab">
                                                <p class="text"> @if(session()->get('language') == 'nepali'){!! $product->long_des_nep !!} @else {!! $product->long_des_en !!} @endif</p>
                                            </div>
                                        </div><!-- /.tab-pane -->





                                        <div id="review" class="tab-pane">
                                            <div class="product-tab">

                                                <div class="product-reviews">
                                                    <h4 class="title">Customer Reviews</h4>


                                                    @php
                                                    $reviews = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->limit(5)->get();
                                                    @endphp


                                                    <div class="reviews">

                                                        @foreach($reviews as $item)

                                                        <!-- @if($item->status == 0)


                                                        @else -->

                                                        <div class="review">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <img src="{{ (!empty($item->user->profile_photo_path)) ? url('upload/user_images/'.$item->user->profile_photo_path) : url('upload/no_image.png') }}" alt="User Profile pic" class="card-img-top" style="border-radius: 50%;" height="40%" width="40%"><b>{{$item->user->name }}<br>

                                                                        @if($item->rating == NULL)
                                                                        @elseif($item->rating == 1)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 2)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 3)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        @elseif($item->rating == 4)

                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        @elseif($item->rating == 5)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        @endif
                                                                    </b>

                                                                </div>

                                                                <div class="col-md-6">

                                                                </div>
                                                            </div>
                                                            <div class="review-title"><span class="summary">{{$item->summary}}</span><span class="date"><i class="fa fa-calendar"></i><span>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span></span></div>
                                                            <div class="text">"{!!$item->comment !!}"</div>
                                                        </div>

                                                        <!-- @endif -->
                                                        @endforeach

                                                    </div><!-- /.reviews -->


                                                </div><!-- /.product-reviews -->



                                                <div class="product-add-review">
                                                    <h4 class="title">Write your own review</h4>


                                                    <div class="review-table">

                                                    </div><!-- /.review-table -->



                                                    <div class="review-form">
                                                        @guest

                                                        <p><b>For Add Product Review, You need to Login First. <a href="{{route('login')}}">Login Here</a></b></p>

                                                        @else
                                                        <div class="form-container">


                                                            <form role="form" class="cnt-form" method="POST" action="{{ route('store.review') }}">
                                                                @csrf

                                                                <input type="hidden" name="product_id" value="{{$product->id}}">

                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="cell-label">&nbsp;</th>
                                                                            <th>1 star</th>
                                                                            <th>2 stars</th>
                                                                            <th>3 stars</th>
                                                                            <th>4 stars</th>
                                                                            <th>5 stars</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="cell-label">Rating</td>
                                                                            <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                            <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>



                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group">
                                                                            <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                            <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit" class="btn btn-primary btn-upper">SUBMIT
                                                                        REVIEW</button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->



                                                        </div><!-- /.form-container -->

                                                        @endguest
                                                    </div><!-- /.review-form -->




                                                </div><!-- /.product-add-review -->

                                            </div><!-- /.product-tab -->
                                        </div><!-- /.tab-pane -->







                                    </div><!-- /.tab-content -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.product-tabs -->

                        <!-- ===========================Hamro recommendation Content bases=================== UPSELL PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Similar products</h3>
                            <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                                @foreach($related_products as $product)

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


                            </div><!-- /.home-owl-carousel -->
                        </section><!-- /.section -->
                        <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
                        <hr><br>


                        <!-- ===========================Hamro recommendation Collaborative garne hai yeha bases=================== UPSELL PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Who Bought This also Bought:</h3>
                            <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                                @foreach($related_products as $product)

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


                            </div><!-- /.home-owl-carousel -->
                        </section><!-- /.section -->
                        <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                    </div><!-- /.col -->
                    <div class="clearfix"></div>
                </div><!-- /.row -->

























                <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
                <div id="brands-carousel" class="logo-slider wow fadeInUp">

                    <div class="logo-slider-inner">
                        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                            <div class="item m-t-15">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item m-t-10">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                                </a>
                            </div>
                            <!--/.item-->
                        </div><!-- /.owl-carousel #logo-slider -->
                    </div><!-- /.logo-slider-inner -->

                </div><!-- /.logo-slider -->
                <!-- == = BRANDS CAROUSEL : END = -->
            </div><!-- /.container -->
        </div><!-- /.body-content -->

    </div>
</div>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6319c600efb7fb62"></script>


@endsection