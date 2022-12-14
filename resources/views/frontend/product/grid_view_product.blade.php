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