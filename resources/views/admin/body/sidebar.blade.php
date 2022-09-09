@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

$site = App\Models\SiteSetting::find(1);


@endphp

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('/admin/dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset($site->logo) }}" alt="">
                        <h3><b>HC</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ ($route == 'dashboard' ) ? 'active':'' }}">
                <a href="{{ url('/admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @php
            $brand = (auth()->guard('admin')->user()->brand == 1);
            $category = (auth()->guard('admin')->user()->category == 1);
            $product = (auth()->guard('admin')->user()->product == 1);
            $slider = (auth()->guard('admin')->user()->slider == 1);
            $coupon = (auth()->guard('admin')->user()->coupon == 1);
            $shipping = (auth()->guard('admin')->user()->shipping == 1);
            $blog = (auth()->guard('admin')->user()->blog == 1);
            $setting = (auth()->guard('admin')->user()->setting == 1);
            $returnorder = (auth()->guard('admin')->user()->returnorder == 1);
            $review = (auth()->guard('admin')->user()->review == 1);
            $orders = (auth()->guard('admin')->user()->orders == 1);
            $stock = (auth()->guard('admin')->user()->stock == 1);
            $reports = (auth()->guard('admin')->user()->reports == 1);
            $alluser = (auth()->guard('admin')->user()->alluser == 1);
            $adminuserrole = (auth()->guard('admin')->user()->adminuserrole == 1);

            @endphp






            @if($brand == true)
            <li class="treeview {{ ($prefix == '/brand' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="briefcase"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.brand' ) ? 'active':'' }}"><a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brands</a></li>

                </ul>
            </li>
            @else
            @endif


            @if($category == true)
            <li class="treeview {{ ($prefix == '/category' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.category' ) ? 'active':'' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
                    <li class="{{ ($route == 'all.subcategory' ) ? 'active':'' }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All Subcategory</a></li>
                    <li class="{{ ($route == 'all.subsubcategory' ) ? 'active':'' }}"><a href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>All Sub->Subcategory</a></li>
                </ul>
            </li>
            @else
            @endif

            @if($product == true)
            <li class="treeview {{ ($prefix == '/product' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="box"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add.product' ) ? 'active':'' }}"><a href="{{ route('add.product') }}"><i class="ti-more"></i>Add Products</a></li>
                    <li class="{{ ($route == 'manage.product' ) ? 'active':'' }}"><a href="{{route('manage.product') }}"><i class="ti-more"></i>Manage Products</a></li>

                </ul>
            </li>
            @else
            @endif

            @if($slider == true)

            <li class="treeview {{ ($prefix == '/slider' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="box"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.slider' ) ? 'active':'' }}"><a href="{{ route('manage.slider') }}"><i class="ti-more"></i>Manage Slider</a></li>


                </ul>
            </li>
            @else
            @endif

            @if($coupon == true)

            <li class="treeview {{ ($prefix == '/coupon' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="box"></i>
                    <span>Coupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.coupon' ) ? 'active':'' }}"><a href="{{ route('manage.coupon') }}"><i class="ti-more"></i>Manage Coupon</a></li>


                </ul>
            </li>
            @else
            @endif

            @if($shipping == true)

            <li class="treeview {{ ($prefix == '/shipping' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="box"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.province' ) ? 'active':'' }}"><a href="{{ route('manage.province') }}"><i class="ti-more"></i>Manage Province</a></li>


                </ul>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.district' ) ? 'active':'' }}"><a href="{{ route('manage.district') }}"><i class="ti-more"></i>Manage District</a></li>


                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.municipality' ) ? 'active':'' }}"><a href="{{ route('manage.municipality') }}"><i class="ti-more"></i>Manage Municipality</a></li>


                </ul>
            </li>
            @else
            @endif



            <li class="header nav-small-cap">User Interface</li>

            @if($orders == true)
            <li class="treeview {{ ($prefix == '/orders' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="box"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending.orders' ) ? 'active':'' }}"><a href="{{ route('pending.orders') }}"><i class="ti-more"></i>Pending Orders</a></li>

                </ul>
                <!--  -->
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'confirmed.orders' ) ? 'active':'' }}"><a href="{{ route('confirmed.orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'processing.orders' ) ? 'active':'' }}"><a href="{{ route('processing.orders') }}"><i class="ti-more"></i>Processing Orders</a></li>

                </ul>


                <ul class="treeview-menu">
                    <li class="{{ ($route == 'picked.orders' ) ? 'active':'' }}"><a href="{{ route('picked.orders') }}"><i class="ti-more"></i>Picked Orders</a></li>

                </ul>
                <!-- delivered -->
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'shipped.orders' ) ? 'active':'' }}"><a href="{{ route('shipped.orders') }}"><i class="ti-more"></i>shipped Orders</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'delivered.orders' ) ? 'active':'' }}"><a href="{{ route('delivered.orders') }}"><i class="ti-more"></i>Delivered Orders</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'canceled.orders' ) ? 'active':'' }}"><a href="{{ route('canceled.orders') }}"><i class="ti-more"></i>Canceled Orders</a></li>

                </ul>

            </li>
            @else
            @endif

            @if($reports == true)

            <li class="treeview {{ ($prefix == '/reports' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>All Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.reports' ) ? 'active':'' }}"><a href="{{ route('all.reports') }}"><i class="ti-more"></i>All Reports</a></li>

                </ul>




            </li>

            @else
            @endif

            @if($alluser == true)




            <li class="treeview {{ ($prefix == '/alluser' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>All Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.users' ) ? 'active':'' }}"><a href="{{ route('all.users') }}"><i class="ti-more"></i>All Users</a></li>

                </ul>

            </li>


            @else
            @endif

            @if($adminuserrole == true)


            <li class="treeview {{ ($prefix == '/adminuserrole' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Admin User Role</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.admin-users' ) ? 'active':'' }}"><a href="{{ route('all.admin-users') }}"><i class="ti-more"></i>All Admin Users</a></li>

                </ul>

            </li>
            @else
            @endif

            @if($blog == true)



            <li class="treeview {{ ($prefix == '/blog' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="hard-drive"></i>
                    <span>Manage Blogs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'blog.category' ) ? 'active':'' }}"><a href="{{ route('blog.category') }}"><i class="ti-more"></i>Blog Category</a></li>

                </ul>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'list.post' ) ? 'active':'' }}"><a href="{{ route('list.post') }}"><i class="ti-more"></i>View Blog List</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add.post' ) ? 'active':'' }}"><a href="{{ route('add.post') }}"><i class="ti-more"></i>Add Blog Post</a></li>

                </ul>


            </li>
            @else
            @endif

            @if($setting == true)

            <li class="treeview {{ ($prefix == '/setting' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Manage Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'site.setting' ) ? 'active':'' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'seo.setting' ) ? 'active':'' }}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>SEO Setting</a></li>

                </ul>

            </li>
            @else
            @endif

            @if($returnorder == true)

            <li class="treeview {{ ($prefix == '/return' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Return Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'return.request' ) ? 'active':'' }}"><a href="{{ route('return.request') }}"><i class="ti-more"></i>Return Request</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.request' ) ? 'active':'' }}"><a href="{{ route('all.request') }}"><i class="ti-more"></i>Approved Return Order</a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'rejected.request' ) ? 'active':'' }}"><a href="{{ route('rejected.request') }}"><i class="ti-more"></i>Rejected Return Order</a></li>

                </ul>

            </li>



            <li class="header nav-small-cap">EXTRA</li>


            @else
            @endif

            @if($review == true)


            <li class="treeview {{ ($prefix == '/review' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Review Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending.reviews' ) ? 'active':'' }}"><a href="{{ route('pending.reviews') }}"><i class="ti-more"></i>All Pending Reviews </a></li>

                </ul>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'approved.reviews' ) ? 'active':'' }}"><a href="{{ route('approved.reviews') }}"><i class="ti-more"></i>All Approved Reviews </a></li>

                </ul>

                <ul class="treeview-menu">
                    <li class="{{ ($route == 'rejected.reviews' ) ? 'active':'' }}"><a href="{{ route('rejected.reviews') }}"><i class="ti-more"></i>All Rejected Reviews </a></li>

                </ul>

            </li>

            @else
            @endif

            @if($stock == true)


            <li class="treeview {{ ($prefix == '/stock' ) ? 'active':'' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Manage Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.stock' ) ? 'active':'' }}"><a href="{{ route('product.stock') }}"><i class="ti-more"></i>Product Stock </a></li>

                </ul>


            </li>
            @else
            @endif

            <li>
                <a href="{{ route('admin.logout') }}">
                    <i data-feather="lock"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>