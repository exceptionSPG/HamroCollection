 <!-- ============================================================= FOOTER ============================================================= -->

 @php
 $site = App\Models\SiteSetting::find(1);
 @endphp
 <footer id="footer" class="footer color-bg">
     <div class="footer-bottom">
         <div class="container">
             <div class="row">
                 <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="module-heading">
                         <h4 class="module-title">Contact Us</h4>
                     </div>
                     <!-- /.module-heading -->

                     <div class="module-body">
                         <ul class="toggle-footer">
                             <li class="media">
                                 <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                 <div class="media-body">
                                     <p>{{ $site->company_name}},{{ $site->company_address}}</p>
                                 </div>
                             </li>
                             <li class="media">
                                 <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                 <div class="media-body">
                                     <p>{{ $site->phone_one}}<br>
                                         {{ $site->phone_two}}
                                     </p>
                                 </div>
                             </li>
                             <li class="media">
                                 <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                 <div class="media-body"> <span><a href="mailto:{{ $site->email}}">{{ $site->email}}</a></span> </div>
                             </li>
                         </ul>
                     </div>
                     <!-- /.module-body -->
                 </div>
                 <!-- /.col -->

                 <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="module-heading">
                         <h4 class="module-title">Customer Service</h4>
                     </div>
                     <!-- /.module-heading -->

                     <div class="module-body">
                         <ul class='list-unstyled'>
                             @auth

                             <li class="first"><a href="{{ route('dashboard') }}" title="My Account">My Account</a></li>
                             <li><a href="{{route('my.orders') }}" title="Order History">Order History</a></li>
                             @else
                             <li><a href="{{ route('login') }}">Login/Register </a></li>

                             @endauth


                             <li><a href="{{ route('shop.page') }}" title="Specials">Specials</a></li>
                             <li><a href="{{ route('about-us') }}" title="About us">About Us</a></li>

                         </ul>
                     </div>
                     <!-- /.module-body -->
                 </div>
                 <!-- /.col -->

                 <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="module-heading">
                         <h4 class="module-title">Corporation</h4>
                     </div>
                     <!-- /.module-heading -->

                     <div class="module-body">
                         <ul class='list-unstyled'>
                             <li class="first"><a title="About us" href="{{ route('about-us') }}">About us</a></li>
                             <li><a title="Return Policy" href="{{ route('return-policy') }}">Return Policy</a></li>
                             <li class="last"><a title="Refund Policy" href="{{ route('refund-policy') }}">Refund Policy</a></li>


                         </ul>
                     </div>
                     <!-- /.module-body -->
                 </div>
                 <!-- /.col -->

                 <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="module-heading">
                         <h4 class="module-title">Why Choose Us</h4>
                     </div>
                     <!-- /.module-heading -->

                     <div class="module-body">
                         <ul class='list-unstyled'>
                             <li class="first"><a href="{{route('shop.page')}}" title="Shop With us">Shopping Guide</a></li>
                             <li><a href="{{route('home.blog') }}" title="Blog">Blog</a></li>
                             <li><a href="{{url('/')}}" title="Company">Home Page</a></li>

                             <li class=" last"><a href="{{ route('bank-details') }}" title="Bank Details">Bank Details</a></li>
                         </ul>
                     </div>
                     <!-- /.module-body -->
                 </div>
             </div>
         </div>
     </div>
     <div class="copyright-bar">
         <div class="container">
             <div class="col-xs-12 col-sm-6 no-padding social">
                 <ul class="link">
                     <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{$site->facebook}}" title="Facebook"></a></li>
                     <li class="tw pull-left"><a target="_blank" rel="nofollow" href="{{$site->twitter}}" title="Twitter"></a></li>

                     <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{$site->linkedin}}" title="Linkedin"></a></li>
                     <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="{{$site->youtube}}" title="Youtube"></a></li>
                 </ul>
             </div>
             <div class="col-xs-12 col-sm-6 no-padding">
                 <div class="clearfix payment-methods">
                     <ul>
                         <li><img src="assets/images/payments/1.png" alt=""></li>
                         <li><img src="assets/images/payments/2.png" alt=""></li>
                         <li><img src="assets/images/payments/3.png" alt=""></li>
                         <li><img src="assets/images/payments/4.png" alt=""></li>
                         <li><img src="assets/images/payments/5.png" alt=""></li>
                     </ul>
                 </div>
                 <!-- /.payment-methods -->
             </div>
         </div>
     </div>
 </footer>
 <!-- ============================================================= FOOTER : END============================================================= -->