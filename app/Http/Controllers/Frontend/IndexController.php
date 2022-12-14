<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use App\ProductSimilarity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index()
    {
        $featured = Product::where('featured', '1')->where('status', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $special_offer = Product::where('special_offer', '1')->where('status', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeals = Product::where('hot_deals', '1')->where('discount_price', '!=', NULL)->where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $specialDeals = Product::where('special_deals', '1')->where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', '1')->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', '1')->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();

        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status', '1')->where('brand_id', $skip_brand_1->id)->orderBy('id', 'DESC')->get();

        $blogs = BlogPost::orderBy('id', 'DESC')->limit(4)->get();

        //$trending = OrderItem::select('product_id')->groupBy('product_id')->orderBy('product_id');
        //dd($trending);
        $trending = DB::table('order_items')->orderBy('sum', 'DESC')->groupBy('product_id')->limit(5)->selectRaw('product_id,sum(qty) as sum')->pluck('product_id', 'sum');
        //dd($trending);

        // return $skip_category->id;
        // die();
        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hotDeals', 'special_offer', 'specialDeals', 'skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_brand_product_1', 'skip_brand_1', 'blogs', 'trending'));
    } //end method

    public function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    } //endmethod

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    } //end method

    public function UserProfileStore(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;


        if ($request->file('profile_photo_path')) {
            $image = $request->profile_photo_path;
            if ($user->profile_photo_path) {
                @unlink(public_path('upload/user_images/' . $user->profile_photo_path));
            }
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/user_images'), $filename);
            $user['profile_photo_path'] = $filename;
        }
        $user->save();
        $notification = array(
            'message' => 'User Profile updated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->route('dashboard')->with($notification);
    } //end method

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    } //end method

    public function UserPasswordUpdate(Request $request)
    {
        //
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required | confirmed',
        ]);
        $hashed_password = User::find(Auth::user()->id)->password;

        if (Hash::check($request->current_password, $hashed_password)) {
            $admin = User::find(Auth::user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            $notification = array(
                'message' => 'Password updated successfully',
                'alert-type' => 'success',

            );
            return redirect()->route('user.logout')->with($notification);
        } else {
            $notification = array(
                'message' => 'Current Password do not match.',
                'alert-type' => 'warning',

            );

            return redirect()->back()->with($notification);
        }
    } //end method




    public function ProductDetails($id, $product_slug_en)
    {
        $product = Product::findOrFail($id);
        $multiImg = MultiImg::where('product_id', $id)->get();

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_nep = $product->product_color_nep;
        $product_color_nep = explode(',', $color_nep);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_nep = $product->product_size_nep;
        $product_size_nep = explode(',', $size_nep);

        //recommendation ko lagi
        $cat_id = $product->category_id;
        $brand_id = $product->brand_id;
        $related_products = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();


        $subsub_id = $product->subsubcategory_id;

        $breadsubcat = SubSubCategory::with('category', 'subcategory')->where('id', $subsub_id)->get();


        //trending recomm
        $cat_trending = DB::table('order_items')
            ->join('products', function ($join) {
                $join->on("order_items.product_id", "=", "products.id");
            })
            ->where("category_id", "=", $cat_id)
            ->where('order_items.product_id', '!=', $id)
            ->orderBy('sum', 'DESC')
            ->groupBy('product_id')
            ->limit(5)
            ->selectRaw('product_id,sum(qty) as sum')
            ->get();


        //brand recomm
        $brand_trending = DB::table('order_items')
            ->join('products', function ($join) {
                $join->on("order_items.product_id", "=", "products.id");
            })
            ->where("brand_id", "=", $brand_id)
            ->where('order_items.product_id', '!=', $id)
            ->orderBy('sum', 'DESC')->groupBy('product_id')->limit(5)->selectRaw('product_id,sum(qty) as sum')->get();


        //user who bought this also bought...
        $id_this = $id;
        DB::statement(DB::raw('SET @hamro_id = ' . $id_this));
        $users_likes = DB::table('products')
            ->select('*')
            ->whereIn('id', (function ($query) {
                $query->from('order_items')
                    ->select('product_id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->whereIn('user_id', (function ($query) {
                        $query->from('order_items')
                            ->select('user_id')
                            ->join('orders', 'order_items.order_id', '=', 'orders.id')
                            ->join('products', 'order_items.product_id', '=', 'products.id')
                            ->where('product_id', '=', DB::raw('@hamro_id'));
                    }))
                    ->where('product_id', '!=', DB::raw('@hamro_id'))
                    ->groupBy('product_id');
            }))
            ->limit(5)
            ->get();

        //Machine Learning wala ko lagi..
        $products = Product::where('status', '1')->with('category')->get()->toArray();


        // $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
        $selectedId      = $id;
        //$selectedProduct = $products[0];

        $productSimilarity = new ProductSimilarity($products);
        // $mal = $productSimilarity->setFeatureWeight(10);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $sorted_products          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);

        $top_recommended_items = array_slice($sorted_products, 0, 5, true);

        // dd($sorted_products);
        return view('frontend.product.product_details', compact('product', 'multiImg', 'product_color_en', 'product_color_nep', 'product_size_en', 'product_size_nep', 'related_products', 'breadsubcat', 'cat_trending', 'brand_trending', 'users_likes', 'top_recommended_items'));
    } //end method TagWiseProduct

    public function TagWiseProduct($tags)
    {
        $products = Product::where('status', 1)->where('product_tags_en', $tags)->orWhere('product_tags_nep', $tags)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    } //end method  

    public function SubCatWiseProduct(Request $request, $subcat_id, $subcategory_slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $breadsubcat = SubCategory::with('category')->where('id', $subcat_id)->get();

        //For Load More Products with ajax

        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))
                ->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))
                ->render();

            return response()->json(['grid_view' => $grid_view, 'list_view' => $list_view]);
        }
        //end Load More with ajax



        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcat'));
    } //end method 


    public function SubSubCatWiseProduct($subsubcat_id, $sub_subcategory_slug)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $breadsubcat = SubSubCategory::with('category', 'subcategory')->where('id', $subsubcat_id)->get();

        return view('frontend.product.sub_subcategory_view', compact('products', 'categories', 'breadsubcat'));
    } //end method


    ///Product view with ajax Modal
    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);
        //$multiImg = MultiImg::where('product_id', $id)->get();

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,

        ));
    } //end method

    public function ProductSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $item = $request->search;
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();


        return view('frontend.product.search', compact('products', 'categories', 'item'));
    } //end method 

    /*******Advance search methods */
    public function AdvProductSearch(Request $request)
    {
        $request->validate(['search' => 'required']);

        $item = $request->search;

        $products = Product::where('product_name_en', 'LIKE', "%$item%")->orWhere('selling_price', 'LIKE', "%$item%")->select('id', 'product_name_en', 'product_thumbnail', 'selling_price', 'product_slug_en')->limit(5)->get();


        return view('frontend.product.search_product', compact('products'));
    } //end method


}
