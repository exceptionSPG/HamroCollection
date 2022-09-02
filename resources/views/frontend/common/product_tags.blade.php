@php
$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
$tags_nep = App\Models\Product::groupBy('product_tags_nep')->select('product_tags_nep')->get();

@endphp


<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>

    <div class="sidebar-widget-body outer-top-xs">

        <div class="tag-list">

            @if(session()->get('language') == 'nepali')
            @foreach($tags_nep as $tag)
            <a class="item active" title="{{ $tag->product_tags_nep }}" href="{{ url('product/tag/'.$tag->product_tags_nep) }}">{{ $tag->product_tags_nep }}

            </a>
            @endforeach

            @else
            @foreach($tags_en as $tag)
            <a class="item active" title="{{ $tag->product_tags_en }}" href="{{ url('product/tag/'.$tag->product_tags_en) }}">
                {{ $tag->product_tags_en }}

            </a>
            @endforeach
            @endif


        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->