<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">


        @php


        $hotDeals = App\Models\Product::where('hot_deals', '1')->where('discount_price', '!=', NULL)->where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        @endphp
        @foreach($hotDeals as $product)
        <div class="item">
            <div class="products">

                <div class="hot-deal-wrapper">

                    <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price)*100;
                    @endphp
                    @if($discount == Null)

                    @else
                    <div class="sale-offer-tag">
                        <span>{{ round($discount) }}%<br>
                            off</span>
                    </div>
                    @endif

                    <div class="timing-wrapper">
                        <!-- <div class="box-wrapper">
                                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                                        </div>
                                        <div class="box-wrapper hidden-md">
                                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                                        </div> -->
                    </div>
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'nepali'){{ $product->product_name_nep }} @else {{ $product->product_name_en }} @endif</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="product-price">
                        <span class="price">Rs. {{ $product->discount_price }}</span>



                    </div>


                    <!-- /.product-price -->

                </div>
                <!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <li class="add-cart-button btn-group">

                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </li>



                            <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="fa fa-heart"></i> </button>


                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
        <!-- END Hot Deals foreach -->


    </div>
    <!-- /.sidebar-widget -->
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->