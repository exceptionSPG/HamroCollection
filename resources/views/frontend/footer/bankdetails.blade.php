@extends('frontend.main_master')
@section('title')
About Us - HamroCollection
@endsection
@section('content')

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            <div class="row" style="background-color: #FEFBF6 ; padding-top: 15px; padding-bottom: 15px;">
                <div class="col-md-4 x-text text-center">
                    <h2>Bank Details</h2>
                    <h5>Address: Kathamandu</h5>
                    <h5>Phone: +977- 9860809359</h5>
                    <h5>Sunday - Friday: 10 AM to 6 PM</h5><br>
                    <h2>NIC Asia Bank: </h2>
                    <h5>Account Name: Hamrocollection</h5>
                    <h5>Account Number: 0174150033997004</h5>
                    <h5>Branch: Samakhusi, Kathmandu</h5>
                    <h5>SWIFT Code: NICENPKA</h5>
                    <h5>Branch Code: 17</h5>
                </div>
                <div class="col-md-8 x-text text-center">
                    <img src="{{ asset('upload/footer/NIC.jpg') }}" style="height: 300px; " />
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div>

@endsection