@php

$brands = App\Models\Brand::latest()->get();
@endphp


<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

            @foreach($brands as $item)

            <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="{{ asset($item->brand_image) }}" src="{{ asset($item->brand_image) }}" alt="" width="60px" height="60px"> </a> </div>
            <!--/.item-->

            @endforeach


        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>
<!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->