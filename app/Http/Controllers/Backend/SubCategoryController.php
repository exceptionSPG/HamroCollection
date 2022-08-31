<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

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
        SubSubCategory::where('subcategory_id', $id)->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method

    /* 
    ************Sub Subcategory **************
    */

    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sub_cats = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $sub_sub = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('sub_cats', 'categories', 'sub_sub'));
    } //end method

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    } //end method 

    public function SubSubCategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_name_nep' => 'required',
            'sub_subcategory_name_en' => 'required',

        ], [
            'sub_subcategory_name_nep.required' => 'Input Sub SubCategory English Name',
            'sub_subcategory_name_en.required' => 'Input Sub SubCategory Nepali Name',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_nep' => $request->sub_subcategory_name_nep,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_nep' => str_replace(' ', '-', $request->sub_subcategory_name_nep),

        ]);

        $notification = array(
            'message' => 'Sub SubCategory Added Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method  
    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('subsubcategory', 'categories', 'subcategories'));
    } //end method  

    public function SubSubCategoryUpdate(Request $request)
    {
        $subsub_id = $request->id;


        SubSubCategory::findOrFail($subsub_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_nep' => $request->sub_subcategory_name_nep,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_nep' => str_replace(' ', '-', $request->sub_subcategory_name_nep),

        ]);

        $notification = array(
            'message' => 'Sub SubCategory updated Successfully.',
            'alert-type' => 'info',

        );

        return redirect()->route('all.subsubcategory')->with($notification);
    } //end method  


    public function SubSubCategoryDelete($id)
    {

        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub SubCategory Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method


}
