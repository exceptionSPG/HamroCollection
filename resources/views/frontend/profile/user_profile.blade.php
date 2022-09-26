@extends('frontend.main_master')
@section('title')
Profile Update - HamroCollection
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
                                <input type="tel" id="phone" name="phone" placeholder="9xxxxxxxxx" pattern="[9][0-9]{9}" style="width:100%;" value="{{ $user->phone }}" class="form-control" onkeypress="return isNumberKey7(event)">

                                <!-- <input type="text" name="phone" id="phone" class="form-control"> -->

                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Profile Image </label>
                                <input type="file" name="profile_photo_path" accept="image/png, image/jpeg" class="form-control">

                            </div>
                            <button type="submit" class="btn btn-danger">Update</button><br><br>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<script>
    function isNumberKey7(e) {
        if (e.keyCode === 9999999999) return true;
        var currentChar = parseInt(String.fromCharCode(e.keyCode), 10);
        if (!isNaN(currentChar)) {
            var nextValue = $("#phone").val() + currentChar; //It's a string concatenation, not an addition

            if (parseInt(nextValue, 10) <= 9999999999) return true;
        }

        return false;
    }
</script>

@endsection