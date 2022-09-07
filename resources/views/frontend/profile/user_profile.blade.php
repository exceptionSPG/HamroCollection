@extends('frontend.main_master')
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