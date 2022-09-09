<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
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

    /**********************Blog Post all methods */

    public function ViewBlogPost()
    {

        $blogs = BlogPost::with('category')->latest()->get();
        return view('backend.blog.post.list_blog_post', compact('blogs'));
    } //end method


    public function AddBlogPost()
    {
        $blogcats = BlogPostCategory::latest()->get();
        $blogs = BlogPost::latest()->get();
        return view('backend.blog.post.post_view', compact('blogs', 'blogcats'));
    } //end method 


    public function StoreBlogPost(Request $request)
    {

        //   post_title_en	post_title_nep	post_slug_en	post_slug_nep	post_image	post_details_en	post_details_nep 
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(780, 433)->save('upload/blog/' . $name_gen);
        $save_url = 'upload/blog/' . $name_gen;
        BlogPost::insert([
            'category_id' => $request->category_id,

            'post_title_en' => $request->post_title_en,
            'post_title_nep' => $request->post_title_nep,
            'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
            'post_slug_nep' => str_replace(' ', '-', $request->post_title_nep),

            'post_details_en' => $request->post_details_en,
            'post_details_nep' => $request->post_details_nep,


            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Blog Post Inserted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('list.post')->with($notification);
    } //end method 

    public function BlogPostEdit($id)
    {
        $cats = BlogPostCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        return view('backend.blog.post.blogpost_edit', compact('post', 'cats'));
    } //end method 

    public function BlogPostUpdate(Request $request)
    {
        $post_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('post_image')) {
            @unlink($old_img);
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(780, 433)->save('upload/blog/' . $name_gen);
            $save_url = 'upload/blog/' . $name_gen;

            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,

                'post_title_en' => $request->post_title_en,
                'post_title_nep' => $request->post_title_nep,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
                'post_slug_nep' => str_replace(' ', '-', $request->post_title_nep),

                'post_details_en' => $request->post_details_en,
                'post_details_nep' => $request->post_details_nep,


                'post_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Post updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('list.post')->with($notification);
        } else {
            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,

                'post_title_en' => $request->post_title_en,
                'post_title_nep' => $request->post_title_nep,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
                'post_slug_nep' => str_replace(' ', '-', $request->post_title_nep),

                'post_details_en' => $request->post_details_en,
                'post_details_nep' => $request->post_details_nep,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Post updated without Image Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('list.post')->with($notification);
        } //end else
    } //end method 

    public function BlogPostDelete($id)
    {
        $blog = BlogPost::findOrFail($id);
        $image = $blog->post_image;
        unlink($image);

        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Post Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method

}
