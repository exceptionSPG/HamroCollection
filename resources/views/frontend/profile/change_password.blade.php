@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br><br>
                <img src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.png') }}" alt="User Profile pic" class="card-img-top" style="border-radius: 50%;" height="80%" width="80%">
                <ul class="list-group list-group-flush"><br><br>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>

                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>

                    <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>
            </div>
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