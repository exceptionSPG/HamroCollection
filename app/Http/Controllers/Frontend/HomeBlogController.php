<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    //
    public function AddBlogPost()
    {
        $blogs = BlogPost::latest()->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_list', compact('blogs', 'blogcategory'));
    } //end method

    public function DetailsBlogPost($id)
    {

        $blogcategory = BlogPostCategory::latest()->get();
        $blog = BlogPost::findOrFail($id);
        //$blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_details', compact('blog', 'blogcategory'));
    } //end method 

    public function HomeCatBlogPost($id)
    {

        $blogcategory = BlogPostCategory::latest()->get();
        $blogs = BlogPost::where('category_id', $id)->orderBy('id', 'DESC')->get();
        //$blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_cat_lists', compact('blogs', 'blogcategory'));
    } //end method HomeCatBlogPost
}
