<!-- yo chai detail page wala ma jaha single product ko dekhayiyeko xa -->
@php

$reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
$average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
@endphp

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




<!-- Yo chai dherai product haru dekhauda use hune wala hai eg recommendation wala ma -->

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


<!-- product info lai nai replace garne... lafada vayo -->

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