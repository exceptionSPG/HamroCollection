<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\FuncCall;

class AdminUserController extends Controller
{
    //
    public function AllAminRoles()
    {
        $admins = Admin::where('type', 2)->latest()->get();
        return view('backend.role.admin_role_all', compact('admins'));
    } //end method AddAdminRole

    public function AddAdminRole()
    {

        return view('backend.role.admin_role_create');
    } //end method 


    public function StoreAdminRole(Request $request)
    {

        if ($request->file('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;

            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupon' => $request->coupon,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $save_url,
                'created_at' => Carbon::now(),


            ]);
            $notification = array(
                'message' => 'Admin user Role Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->route('all.admin-users')->with($notification);
        } else {
            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupon' => $request->coupon,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'created_at' => Carbon::now(),


            ]);
            $notification = array(
                'message' => 'Admin user Role Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->route('all.admin-users')->with($notification);
        }
    } //end method EditAdminRole

    public function EditAdminRole($id)
    {
        $adminuser = Admin::findOrFail($id);

        return view('backend.role.admin_role_edit', compact('adminuser'));
    } //end method 



    public function UpdateAdminRole(Request $request)
    {
        $admin_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('profile_photo_path')) {
            if ($old_img != null) {
                @unlink($old_img);
            }
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;

            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupon' => $request->coupon,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $save_url,
                'updated_at' => Carbon::now(),


            ]);
            $notification = array(
                'message' => 'Admin User updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('all.admin-users')->with($notification);
        } else {
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupon' => $request->coupon,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'updated_at' => Carbon::now(),


            ]);

            $notification = array(
                'message' => 'Admin User updated without image Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('all.admin-users')->with($notification);
        } //end else
    } //end method

    public function DeleteAdminRole($id)
    {
        $img = Admin::findOrFail($id);
        if ($img != null) {
            @unlink($img->profile_photo_path);
        }
        $del = Admin::findOrFail($id)->delete();
        if ($del) {
            $notification = array(
                'message' => 'Admin User deletedSuccessfully.',
                'alert-type' => 'success',

            );

            return redirect()->route('all.admin-users')->with($notification);
        } else {
            $notification = array(
                'message' => 'Some problem encountered while deleting admin user.',
                'alert-type' => 'error',

            );

            return redirect()->back()->with($notification);
        }
    } //end method



}
