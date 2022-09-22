@extends('frontend.main_master')
@section('title')
SubCategory Product - HamroCollection
@endsection
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                @foreach($breadsubcat as $item)
                <li class='active'>{{$item->category->category_name_en}}</li>
                @endforeach
                @foreach($breadsubcat as $item)
                <li class='active'>{{$item->subcategory_name_en}}</li>
                @endforeach

            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
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


                                    @include('frontend.common.shopby')

                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- ============================================== PRICE SILDER============================================== -->

                        <!-- ============================================== PRICE SILDER : END ============================================== -->
                        <!-- ============================================== MANUFACTURES============================================== -->
                        <!-- brands include garda hunxa -->
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== MANUFACTURES: END ============================================== -->
                        <!-- ============================================== COLOR============================================== -->


                        <!-- ============================================== COLOR: END ============================================== -->



                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        @include('frontend.common.product_tags')
                        <!-- /.sidebar-widget -->


                        <!----------- Testimonials------------->


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
                           <!--  include('frontend.common.sortby') -->
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
                                <div class="row" id="grid_view_product">

                                    @include('frontend.product.grid_view_product')


                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->
                        <!-- Product GRID VIEW started -->


                        <!-- Product LIST VIEW started -->
                        <div class="tab-pane " id="list-container">
                            <div class="category-product" id="list_view_product">

                                @include('frontend.product.list_view_product')





                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                        <!-- Product LIST View End -->


                    </div>
                    <!-- /.tab-content -->

                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">

                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.text-right -->

                    </div>
                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->

            </div>
            <!-- /.col -->

            <div class="ajax-loadmore-product text-center" style="display: none;">
                <img src="{{ asset('frontend/assets/images/loader.svg') }}" alt="" width="120px" height="120px">
            </div>
















        </div>
        <!-- /.row -->


        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->

<script>
    function loadmoreProduct(page) {
        $.ajax({
                type: "GET",
                url: "?page=" + page,
                beforeSend: function(response) {
                    $('.ajax-loadmore-product').show();
                },

            })
            .done(function(data) {
                if (data.grid_view == " " || data.list_view == " ") {
                    return;

                }
                $('.ajax-loadmore-product').hide();
                $('#grid_view_product').append(data.grid_view);
                $('#list_view_product').append(data.list_view);

            })
            .fail(function() {
                alert('Something Went wrong.');
            })
    }
    var page = 1;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadmoreProduct(page);

        }
    });
</script>
@endsection