@extends('frontend.main_master')
@section('title')
Verify Email - HamroCollection
@endsection
@section('content')


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Verify Email</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->


<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Verify your Email</h4>

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div><br><br>
                    <!-- <div class="social-sign-in outer-top-xs">
                        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                    </div> -->


                    @if (session('status') == 'verification-link-sent')
                    <div class="text-danger mb-4 font-medium text-sm text-green-600">
                        <b>{{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}</b>
                    </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-jet-button type="submit" class="btn-upper btn btn-primary checkout-page-button">
                                    {{ __('Resend Verification Email') }}
                                </x-jet-button>
                            </div><br>
                        </form>

                        <div>


                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf

                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>


                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->

    @endsection