<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @php
            $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();


            @endphp

            @foreach($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>@if(session()->get('language') == 'nepali'){{ $category->category_name_nep }} @else {{ $category->category_name_en }} @endif</a>
                <ul class="dropdown-menu mega-menu">



                    <li class="yamm-content">
                        <div class="row">
                            <!-- GET SubCategory Data -->
                            <!-- GET SubCategory Data -->
                            @php
                            $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_en','ASC')->get();


                            @endphp

                            @foreach($subcategories as $subcat)
                            <div class="col-sm-12 col-md-3">

                                <a href="{{url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en)  }}">
                                    <h2 class="title">@if(session()->get('language') == 'nepali'){{ $subcat->subcategory_name_nep }} @else {{ $subcat->subcategory_name_en }} @endif</h2>
                                </a>
                                <ul class="links list-unstyled">

                                    <!-- GET Sub SubCategory Data -->
                                    @php
                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcat->id)->orderBy('sub_subcategory_name_en','ASC')->get();


                                    @endphp

                                    @foreach($subsubcategories as $subsubcat)
                                    <li><a href="{{url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->sub_subcategory_slug_en)  }}">@if(session()->get('language') == 'nepali'){{ $subsubcat->sub_subcategory_name_nep }} @else {{ $subsubcat->sub_subcategory_name_en }} @endif </a></li>
                                    @endforeach
                                    <!-- END Sub Sub Category foreach -->


                                </ul>
                            </div>
                            @endforeach
                            <!-- End subcategory foreach -->
                            <!-- /.col -->


                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->
            @endforeach

           
            <!-- /.menu-item -->






        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->