@extends('frontend.main_master')
@section('title')
Strip Payment - HamroCollection
@endsection
@section('content')

<!-- --------- CSS ------- -->
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
<!-- ----------End CSS -------  -->



<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Strip</li>
            </ul>
        </div><!-- /.breadcrumb-inn{home.html}er -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">

        <div class="checkout-box ">
            <div class="row">

                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Shopping Amount:</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">



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




                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method:</h4>
                                </div>


                                <form action="{{ route('strip.order') }}" method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>

                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary">Submit Payment</button>
                                </form>


                                <!-- End row -->


                            </div>


                        </div>

                    </div>

                </div>
                <!-- end col-md-6 -->




            </div><!-- /.row -->
        </div><!-- /.checkout-box -->

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

    </div><!-- /.container -->
</div><!-- /.body-content -->


<!-- pk_test_51LeshtSE0cXsZe224gC1SvkEh4auWzwjIShviMYblYAX3nlDX95WGCzJW1aeK4dLEunSpfqMoXiE3QqGXEbH7BlZ005b4JcjTx -->



<!-- ----------End JavaScript --------->


@endsection