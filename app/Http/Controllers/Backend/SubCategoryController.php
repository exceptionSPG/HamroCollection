<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    //
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sub_cats = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('sub_cats', 'categories'));
    } //end method

    public function SubCategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_nep' => 'required',

        ], [
            'subcategory_name_en.required' => 'Input SubCategory English Name',
            'subcategory_name_nep.required' => 'Input SubCategory Nepali Name',
        ]);


        SubCategory::insert([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_nep' => $request->subcategory_name_nep,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_nep' => str_replace(' ', '-', $request->subcategory_name_nep),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'SubCategory Added Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcat = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcat', 'categories'));
    } //end method  

    public function SubCategoryUpdate(Request $request)
    {
        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_nep' => $request->subcategory_name_nep,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_nep' => str_replace(' ', '-', $request->subcategory_name_nep),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'SubCategory updated Successfully.',
            'alert-type' => 'info',

        );

        return redirect()->route('all.subcategory')->with($notification);
    } //end method 


    public function SubCategoryDelete($id)
    {
        $cat = SubCategory::findOrFail($id);


        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method
}
