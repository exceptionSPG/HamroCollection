@extends('frontend.main_master')
@section('title')
Checkout Page - HamroCollection
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inn{home.html}er -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">

        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">



                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- Shipping Address-->


                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                            <form class="register-form" action="{{route('checkout.store') }}" method="POST" role="form">
                                                @csrf


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping Name: <span>*</span></b></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="shipping_name" value="{{ Auth::user()->name }}" required="">
                                                </div>


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping Email: <span>*</span></b></label>
                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="shipping_email" value="{{ Auth::user()->email }}" required="">
                                                </div>


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping Phone: <span>*</span></b></label>
                                                    <input type="number" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="shipping_email" value="{{ Auth::user()->phone }}" required="" placeholder="Phone">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Post Code: <span>*</span></b></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="shipping_email" required="" placeholder="Postal Code">
                                                </div>



                                        </div>
                                        <!-- Shipping Address- -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">


                                            <div class="form-group">
                                                <h5><b>Province Select <span class="text-danger">*</span></b></h5>
                                                <div class="controls">
                                                    <select name="province_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Province</option>
                                                        @foreach($provinces as $item)
                                                        <option value="{{ $item->id }}">{{ $item->province_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>

                                            </div>
                                            <!-- end form group -->

                                            <div class="form-group">
                                                <h5><b>District Select <span class="text-danger">*</span></b></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required="">
                                                        <option selected="" disabled>Select District</option>

                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end form group -->

                                            <div class="form-group">
                                                <h5> <b>Local State Select <span class="text-danger">*</span></b></h5>
                                                <div class="controls">
                                                    <select name="municipal_id" class="form-control" required="">
                                                        <option selected="" disabled>Select Local State</option>
                                                    </select>


                                                    @error('municipal_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>

                                            </div>
                                            <!-- end form group -->

                                            <div class="form-group">
                                                <h5><b> Ward No. and Chowk Name: <span class="text-danger">*</span></b></h5>
                                                <textarea name="notes" id="" cols="40" rows="10" placeholder="Ward No. 2, Chadani Chowk "></textarea>

                                                @error('notes')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                            </div>

                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->


                        <!-- yeha tala aru checkout step thiye hai -->



                    </div><!-- /.checkout-steps -->
                </div>


                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Shopping Details:</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                        <li>
                                            <strong>Image:</strong> <img src="{{ asset($item->options->image) }}" alt="" style="height: 50px; width: 50px;">
                                        </li>


                                        <li>
                                            <strong>Quantity:</strong> ({{ $item->qty }})
                                            <strong>Color:</strong> {{ $item->options->color }}
                                            <strong>Size:</strong> {{ $item->options->size }}
                                        </li>
                                        @endforeach



                                        <li>
                                            @if(session()->has('coupon'))
                                            <hr>
                                            <strong>Subtotal:</strong> Rs. {{$cartTotal}}
                                            <hr>
                                            <strong>Coupon Applied:</strong> {{session()->get('coupon_name')}} ( {{session()->get('coupon_discount')}}% )
                                            <hr>
                                            <strong>Discount Amount:</strong>Rs. {{session()->get('discount_amount')}}
                                            <hr>
                                            <strong>Grand Total:</strong> Rs. {{session()->get('total_amount')}}
                                            <hr>

                                            @else
                                            <hr>
                                            <strong>Subtotal:</strong> Rs. {{$cartTotal}}
                                            <hr>
                                            <strong>Grand Total:</strong> Rs. {{$cartTotal}}
                                            <hr>

                                            @endif
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>




                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method:</h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">

                                        <label for="stripe">Khalti</label>
                                        <input type="radio" name="payment_method" value="khalti">
                                        <img src="{{asset('frontend/assets/images/payments/khalti.png') }}" alt="" style="height: 30px; width: 50px;">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="stripe">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{asset('frontend/assets/images/payments/4.png') }}" alt="">

                                    </div>
                                    <div class="col-md-4">
                                        <label for="stripe">Cash:</label>
                                        <input type="radio" name="payment_method" value="cash">
                                        <img src="{{asset('frontend/assets/images/payments/5.png') }}" alt="">

                                    </div>


                                </div>

                                @error('payment_method')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- End row -->
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>



                            </div>


                        </div>

                    </div>

                </div>
                <!-- checkout-progress-sidebar -->
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

    </div><!-- /.container -->
</div><!-- /.body-content -->





<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="province_id"]').on('change', function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: "{{ url('/checkout/district-get/ajax') }}/" + province_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="municipal_id" ]').empty();
                        var d = $('select[name="district_id" ]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id" ]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });



        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/checkout/municipals-get/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="municipal_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="municipal_id"]').append('<option value="' + value.id + '">' + value.municipal_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
@endsection