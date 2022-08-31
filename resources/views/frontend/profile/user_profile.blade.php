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
                        <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name </label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">

                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email </label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">

                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone </label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">

                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Profile Image </label>
                                <input type="file" name="profile_photo_path" class="form-control">

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