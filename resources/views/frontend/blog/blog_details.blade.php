@extends('frontend.main_master')
@section('title')
{{ $blog->post_title_en }} - HamroCollection
@endsection
@section('content')



<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/') }}">Home</a></li>
                <li class='active'>{{ $blog->post_title_en }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md-9">


                    <div class="blog-post wow fadeInUp">

                        <img class="img-responsive" src="{{ asset($blog->post_image) }}" alt="">
                        <h1>@if(session()->get('language') == 'nepali'){{ $blog->post_title_nep }} @else {{ $blog->post_title_en }} @endif</h1>
                        <span class="author">Admin</span>
                        <!-- <span class="review">7 Comments</span> -->

                        <span class="date-time">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</span>

                        <p>@if(session()->get('language') == 'nepali'){!! $blog->post_details_nep !!} @else {!! $blog->post_details_en !!} @endif</p>


                        <hr>

                        <span>share post on:</span>

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>

                    </div>

                    <!-- include frontend.common.comment -->
                </div>
                <div class="col-md-3 sidebar">



                    <div class="sidebar-module-container">
                        <div class="search-area outer-bottom-small">
                            <form>
                                <div class="control-group">
                                    <input placeholder="Type to search" class="search-field">
                                    <a href="#" class="search-button"></a>
                                </div>
                            </form>
                        </div>

                        <div class="home-banner outer-top-n outer-bottom-xs">
                            <img src="assets/images/banners/LHS-banner.jpg" alt="Image">
                        </div>
                        <!-- ==============================================CATEGORY============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">Category</h3>
                            <div class="sidebar-widget-body m-t-10">

                                <div class="accordion">


                                    <ul class="list-group">
                                        @foreach($blogcategory as $category)
                                        <a href="{{ url('blog/category/post/'.$category->id) }}">
                                            <li class="list-group-item">@if(session()->get('language') == 'nepali'){{ $category->blog_category_name_nep }} @else {{ $category->blog_category_name_en }} @endif</li>
                                        </a>

                                        @endforeach


                                    </ul>


                                </div><!-- /.accordion -->
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== CATEGORY : END ============================================== -->

                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        @include('frontend.common.product_tags')
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6319c600efb7fb62"></script>


@endsection