@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
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


            <li class="header nav-small-cap">User Interface</li>

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
                    <li class="{{ ($route == 'view.post' ) ? 'active':'' }}"><a href="{{ route('view.post') }}"><i class="ti-more"></i>View Blog Post</a></li>

                </ul>

            </li>



            <li class="header nav-small-cap">EXTRA</li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="layers"></i>
                    <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Level One</a></li>
                    <li class="treeview">
                        <a href="#">Level One
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#">Level Two</a></li>
                            <li class="treeview">
                                <a href="#">Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#">Level Three</a></li>
                                    <li><a href="#">Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Level One</a></li>
                </ul>
            </li>

            <li>
                <a href="auth_login.html">
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