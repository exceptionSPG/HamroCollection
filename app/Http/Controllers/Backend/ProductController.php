<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\MultiImg;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    //AddProduct
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    } //end method ProductStore

    public function ProductStore(Request $request)
    {
        //brand_id	category_id	subcategory_id	subsubcategory_id	product_name_en	product_name_nep	product_slug_en	product_slug_nep	product_code	product_qty	product_tags_en	product_tags_nep	product_size_en	product_size_nep	product_color_en	product_color_nep	selling_price	discount_price	short_des_en	short_des_nep	long_des_en	long_des_nep	product_thumbnail	hot_deals	featured	special_offer	special_deals	status

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_nep' => $request->product_name_nep,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_nep' => str_replace(' ', '-', $request->product_name_nep),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_nep' => $request->product_tags_nep,
            'product_size_en' => $request->product_size_en,
            'product_size_nep' => $request->product_size_nep,
            'product_color_en' => $request->product_color_en,
            'product_color_nep' => $request->product_color_nep,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_des_en' => $request->short_des_en,
            'short_des_nep' => $request->short_des_nep,
            'long_des_en' => $request->long_des_en,
            'long_des_nep' => $request->long_des_nep,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        /*************Multiple Image Upload Start *********** product_id	photo_name */
        $images = $request->file('multi_image');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi_image/' . $make_name);
            $upload_path = 'upload/products/multi_image/' . $make_name;
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }
        /*************Multiple Image Upload END *********** */


        $notification = array(
            'message' => 'Product Inserted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('manage.product')->with($notification);
    } //end method ManageProduct

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    } //end method EditProduct

    public function EditProduct($id)
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $multi_images = MultiImg::where('product_id', $id)->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('product', 'categories', 'brands', 'subcategory', 'subsubcategory', 'multi_images'));
    } //end method ProductDataUpdate

    public function ProductDataUpdate(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_nep' => $request->product_name_nep,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_nep' => str_replace(' ', '-', $request->product_name_nep),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_nep' => $request->product_tags_nep,
            'product_size_en' => $request->product_size_en,
            'product_size_nep' => $request->product_size_nep,
            'product_color_en' => $request->product_color_en,
            'product_color_nep' => $request->product_color_nep,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_des_en' => $request->short_des_en,
            'short_des_nep' => $request->short_des_nep,
            'long_des_en' => $request->long_des_en,
            'long_des_nep' => $request->long_des_nep,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Data Updated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('manage.product')->with($notification);
    } //end method ProductMultiImageUpdate

    /*** Multiple image update method******/
    public function ProductMultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_image;

        foreach ($imgs as $id => $img) {
            $imageDel = MultiImg::findOrFail($id);
            unlink($imageDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi_image/' . $make_name);
            $upload_path = 'upload/products/multi_image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $upload_path,
                'updated_at' => Carbon::now(),
            ]);
        } //end foreach
        $notification = array(
            'message' => 'Product Images updated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 
    /*** Multiple image update method END******/

    public function ProductThumbnailUpdate(Request $request)
    {
        $product_id = $request->id;
        $oldImg = $request->old_img;
        unlink($oldImg);

        $image = $request->file('product_thumbnail');
        $thumb_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $thumb_name);
        $save_url = 'upload/products/thumbnail/' . $thumb_name;

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Thumbnail updated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method MultiImageDelete

    public function MultiImageDelete($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImg::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Image Deleted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method ProductInactive


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Product inactivated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Product activated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method ProductDelete

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $image) {
            unlink($image->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }
        $notification = array(
            'message' => 'Product deleted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method


}
