<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //
    public function AdminProfile()
    {
        //
        $id = Auth::user()->id;
        $admin = Admin::find($id);
        return view('admin.admin_profile_view', compact('admin'));
    } //end method 

    public function AdminProfileEdit()
    {
        //
        $id = Auth::user()->id;
        $editData = Admin::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    } //end method

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $image = $request->profile_photo_path;
            @unlink(public_path('upload/admin_images/' . $admin->profile_photo_path));
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/admin_images'), $filename);
            $admin['profile_photo_path'] = $filename;
        }
        $admin->save();
        $notification = array(
            'message' => 'Admin Profile updated with Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('admin.profile')->with($notification);
    } //end method

    public function AdminChangePassword()
    {
        //
        return view('admin.admin_change_password');
    } //end method
    public function UpdateChangePassword(Request $request)
    {
        //
        $id = Auth::user()->id;
        $admin = Admin::find($id);
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required | confirmed',
        ]);
        $hashed_password = Admin::find($id)->password;

        if (Hash::check($request->oldpassword, $hashed_password)) {
            $admin = Admin::find($id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    } //end method

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all_users', compact('users'));
    } //end method
}
