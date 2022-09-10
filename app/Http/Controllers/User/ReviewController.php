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
            'quality' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'rating' => $request->quality,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Review submitted and Will Approved By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method



    public function PendingReviews()
    {
        $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('backend.review.pending_review', compact('reviews'));
    } //end method 

    public function ApprovedReviews()
    {
        $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.review.approved_review', compact('reviews'));
    } //end method ApprovedReviews

    public function RejectedReviews()
    {
        $reviews = Review::where('status', 2)->orderBy('id', 'DESC')->get();
        return view('backend.review.rejected_review', compact('reviews'));
    } //end method 


    public function ReviewApprove($review_id)
    {
        $update = Review::findOrFail($review_id)->update([
            'status' => 1,
        ]);


        $notification = array(
            'message' => 'Review Approved Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 


    public function ReviewReject($review_id)
    {
        $update = Review::findOrFail($review_id)->update([
            'status' => 2,
        ]);


        $notification = array(
            'message' => 'Review Approved Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 

    public function reviewDelete($review_id)
    {
        Review::findOrFail($review_id)->delete();


        $notification = array(
            'message' => 'Review Deleted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //

}
