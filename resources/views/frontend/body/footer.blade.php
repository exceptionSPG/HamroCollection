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
                             <li><a href="#" title="About us">Order History</a></li>
                             @else
                             <li><a href="{{ route('login') }}">Login/Register </a></li>

                             @endauth


                             <li><a href="{{ route('shop.page') }}" title="Popular Searches">Specials</a></li>
                             <li class="last"><a href="#" title="Where is my order?">Contact Us</a></li>
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
                             <li class="first"><a title="Your Account" href="#">About us</a></li>
                             <li><a title="Information" href="#">Customer Service</a></li>
                             <li><a title="Addresses" href="#">Company</a></li>
                             <li><a title="Addresses" href="#">Investor Relations</a></li>
                             <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
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
                             <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                             <li><a href="{{route('home.blog') }}" title="Blog">Blog</a></li>
                             <li><a href="#" title="Company">Company</a></li>
                             <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                             <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
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