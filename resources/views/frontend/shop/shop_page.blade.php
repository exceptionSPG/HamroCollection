@extends('frontend.main_master')
@section('title')
All Products Shop Page - HamroCollection
@endsection
@section('content')



<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">

                <li><a href="{{ url('/') }}">Home</a></li>

                <li class='active'>Shop Page</li>

            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <form action="{{ route('shop.filter') }}" method="post">
            @csrf



            <div class='row'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('frontend.common.vertical_menu')
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->
                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">shop by</h3>

                                <div class="widget-header">
                                    <h4 class="widget-title">Category</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">

                                        @if(!empty($_GET['category']))

                                        @php

                                        $filterCat = explode(',',$_GET['category']);
                                        @endphp

                                        @endif

                                        @foreach($categories as $category)
                                        <div class="accordion-group">

                                            <div class="accordion-heading">
                                                <label for="" class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="category[]" value="{{ $category->category_slug_en }}" onchange="this.form.submit()" @if(!empty($filterCat) && in_array($category->category_slug_en,$filterCat)) checked @endif>@if(session()->get('language') == 'nepali'){{ $category->category_name_nep }} @else {{ $category->category_name_en }} @endif
                                                </label>

                                            </div>
                                            <!-- /.accordion-heading -->

                                        </div>
                                        <!-- /.accordion-group -->
                                        @endforeach

                                    </div>
                                    <!-- /.accordion -->
                                </div>
                                <!-- /.sidebar-widget-body -->



                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->



                            <!-- ============================================== COLOR============================================== -->
                            <!-- rakhne vaye ocmmon ma xa -->
                            <!-- ============================================== COLOR: END ============================================== -->



                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                            @include('frontend.common.product_tags')
                            <!-- /.sidebar-widget -->


                            <!----------- Testimonials------------->

                            <!-- rakhne vaye common ma xa -->
                            <!-- ============================================== Testimonials: END ============================================== -->




                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->


                <div class='col-md-9'>
                    <!-- ========================================== SECTION – HERO ========================================= -->



                    <div class="clearfix filters-container m-t-10">
                        <div class="row">

                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                                    </ul>
                                </div>
                                <!-- /.filter-tabs -->
                            </div>
                            <!-- /.col -->

                            <div class="col col-sm-12 col-md-6">

                            </div>
                            <!-- /.col -->

                            <div class="col col-sm-6 col-md-4 text-right">

                                <!-- /.pagination-container -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->

                    </div>

                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">

                            <!-- Product GRID VIEW STARTED  -->

                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">

                                        @foreach($products as $product)

                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
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
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->

                            </div>
                            <!-- /.tab-pane -->
                            <!-- Product GRID VIEW started -->


                            <!-- Product LIST VIEW started -->
                            <div class="tab-pane " id="list-container">
                                <div class="category-product">

                                    @foreach($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">

                                                <div class="row product-list-row">

                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->

                                                    <div class="col col-sm-8 col-lg-8">

                                                        <div class="product-info">
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
                                                    </div>
                                                    <!-- /.col -->


                                                </div>
                                                <!-- /.product-list-row -->
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
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.category-product-inner -->


                                    @endforeach





                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane #list-container -->
                            <!-- Product LIST View End -->


                        </div>
                        <!-- /.tab-content -->

                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}

                    </div>
                    <!-- /.search-result-container -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- ============================================== BRANDS CAROUSEL ============================================== -->

            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

        </form>
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->


@endsection