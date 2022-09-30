@php
$user = APP\Models\User::find(Auth::id());
$route = Route::current()->getName();
@endphp



<div class="col-md-2"><br><br>
    <img src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.png') }}" alt="User Profile pic" class="card-img-top" style="border-radius: 50%;" height="80%" width="80%">
    <ul class="list-group list-group-flush"><br><br>
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'dashboard' ) ? 'active':'' }}">Home</a>

        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'user.profile' ) ? 'active':'' }}">Profile Update</a>

        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'user.change.password' ) ? 'active':'' }}">Change Password</a>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'my.orders' ) ? 'active':'' }}">My Orders</a>

        <a href="{{ route('return.orders.list') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'return.orders.list' ) ? 'active':'' }}">Return Orders</a>

        <!-- <a href="{{ route('cancel.orders.list') }}" class="btn btn-primary btn-sm btn-block {{ ($route == 'cancel.orders.list' ) ? 'active':'' }}">Cancel Orders</a> -->

        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block {{ ($route == 'user.logout' ) ? 'active':'' }}">Logout</a>

    </ul>
</div>