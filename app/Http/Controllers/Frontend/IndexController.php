<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.index', compact('categories', 'sliders', 'products'));
    } //end method

    public function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    } //endmethod

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    } //end method

    public function UserProfileStore(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;


        if ($request->file('profile_photo_path')) {
            $image = $request->profile_photo_path;
            if ($user->profile_photo_path) {
                @unlink(public_path('upload/user_images/' . $user->profile_photo_path));
            }
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/user_images'), $filename);
            $user['profile_photo_path'] = $filename;
        }
        $user->save();
        $notification = array(
            'message' => 'User Profile updated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('dashboard')->with($notification);
    } //end method

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    } //end method

    public function UserPasswordUpdate(Request $request)
    {
        //
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required | confirmed',
        ]);
        $hashed_password = User::find(Auth::user()->id)->password;

        if (Hash::check($request->current_password, $hashed_password)) {
            $admin = User::find(Auth::user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            $notification = array(
                'message' => 'Password updated successfully',
                'alert-type' => 'success',

            );
            return redirect()->route('user.logout')->with($notification);
        } else {
            $notification = array(
                'message' => 'Current Password do not match.',
                'alert-type' => 'warning',

            );

            return redirect()->back()->with($notification);
        }
    } //end method




    public function ProductDetails($id, $product_slug_en)
    {
        $product = Product::findOrFail($id);
        $multiImg = MultiImg::where('product_id', $id)->get();
        return view('frontend.product.product_details', compact('product', 'multiImg'));
    } //end method
}
