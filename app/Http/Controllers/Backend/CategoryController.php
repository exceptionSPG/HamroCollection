<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    //
    public function CategoryView()
    {
        $cats = Category::latest()->get();
        return view('backend.category.category_view', compact('cats'));
    } //end method
    public function CategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required',
            'category_name_nep' => 'required',
            'category_icon' => 'required',

        ], [
            'category_name_en.required' => 'Input Category English Name',
            'category_name_nep.required' => 'Input Category Nepali Name',
        ]);


        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_nep' => $request->category_name_nep,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'category_slug_nep' => str_replace(' ', '-', $request->brand_name_nep),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Added Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method

    public function CategoryEdit($id)
    {
        $cat = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('cat'));
    } //end method 

    public function CategoryUpdate(Request $request)
    {
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_nep' => $request->category_name_nep,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_nep' => str_replace(' ', '-', $request->category_name_nep),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category updated Successfully.',
            'alert-type' => 'info',

        );

        return redirect()->route('all.category')->with($notification);
    } //end method 

    public function CategoryDelete($id)
    {
        $cat = Category::findOrFail($id);


        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method
}
