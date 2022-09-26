@extends('frontend.main_master')
@section('title')
Password Update - HamroCollection
@endsection
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-2">


            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi,</span><strong>{{ Auth::user()->name }}</strong> Update Your Profile
                    </h3>
                    <div class="card-body">

                        <form action="{{ route('user.password.update') }}" method="post">
                            @csrf


                            <div class="form-group">
                                <h5>Current Password: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input id="current_password" type="password" name="current_password" class="form-control" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>New Password: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input id="password" type="password" name="password" class="form-control" required="">
                                </div>
                            </div>



                            <div class="form-group">
                                <h5>Confirm Password: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required="">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-danger">Update</button><br><br>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>





@endsection