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