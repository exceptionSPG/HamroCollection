<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function StoreReview(Request $request)
    {
        $product = $request->product_id;

        $request->validate([

            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            //'rating' => $request->quality,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Review submitted and Will Approved By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
}
