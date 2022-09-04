<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function Wishlist()
    {
        $wishs = Wishlist::where('user_id', Auth::id());
        return view('frontend.wishlist.wishlist_view');
    } //end method GetWishlistProducts

    public function GetWishlistProducts()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishlist);
    } //end method RemoveProducts

    public function RemoveProducts($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Product Removed from Wishlist']);
    } //end method
}
