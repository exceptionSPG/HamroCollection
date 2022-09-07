<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function BlogCategory()
    {
        $blogcategory =  BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view', compact('blogcategory'));
    } //end method 

    public function BlogCategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_nep' => 'required',


        ], [
            'blog_category_name_en.required' => 'Input Blog Category English Name',
            'blog_category_name_nep.required' => 'Input Blog Category Nepali Name',
        ]);


        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_nep' => $request->blog_category_name_nep,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'blog_category_slug_nep' => str_replace(' ', '-', $request->blog_category_name_nep),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Category Added Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 

    public function BlogCategoryEdit($id)
    {
        $bcat = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.blogcategory_edit', compact('bcat'));
    } //end method 

    public function BlogCategoryUpdate(Request $request)
    {



        BlogPostCategory::findOrFail($request->id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_nep' => $request->blog_category_name_nep,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'blog_category_slug_nep' => str_replace(' ', '-', $request->blog_category_name_nep),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully.',
            'alert-type' => 'info',

        );

        return redirect()->route('blog.category')->with($notification);
    } //end method  

    public function BlogCategoryDelete($id)
    {
        $cat = BlogPostCategory::findOrFail($id);


        BlogPostCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Post Category Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method
}
