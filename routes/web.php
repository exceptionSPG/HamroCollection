<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');
});

// Admin All routes
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
// Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile'); all.brand
Route::middleware(['auth:admin'])->group(function () {




    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::get('/admin/profile/edit', 'AdminProfileEdit')->name('admin.profile.edit');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/update/change/password', 'UpdateChangePassword')->name('update.change.password');
    });

    //Brands all route
    Route::prefix('brand')->controller(BrandController::class)->group(function () { //brand.delete
        Route::get('/view', 'BrandView')->name('all.brand');
        Route::post('/store', 'BrandStore')->name('brand.store');
        Route::get('/edit/{id}', 'BrandEditHai')->name('brand.edit');
        Route::post('/update', 'BrandUpdate')->name('brand.update');
        Route::get('/delete/{id}', 'BrandDelete')->name('brand.delete');
    });

    //Admin Category All routes
    Route::prefix('category')->controller(CategoryController::class)->group(function () { //all.subcategory
        Route::get('/view', 'CategoryView')->name('all.category');
        Route::post('/store', 'CategoryStore')->name('category.store');
        Route::get('/edit/{id}', 'CategoryEdit')->name('category.edit');
        Route::post('/update', 'CategoryUpdate')->name('category.update');
        Route::get('/delete/{id}', 'CategoryDelete')->name('category.delete');
    });

    //Admin Subcategory All routes
    Route::prefix('category')->controller(SubCategoryController::class)->group(function () { //
        Route::get('/sub/view', 'SubCategoryView')->name('all.subcategory');
        Route::post('/sub/store', 'SubCategoryStore')->name('subcategory.store');
        Route::get('/sub/edit/{id}', 'SubCategoryEdit')->name('subcategory.edit');
        Route::post('/sub/update', 'SubCategoryUpdate')->name('subcategory.update');
        Route::get('/sub/delete/{id}', 'SubCategoryDelete')->name('subcategory.delete');

        //Sub Subcategory All routes
        Route::get('/sub/sub/view', 'SubSubCategoryView')->name('all.subsubcategory');
        //category select huda subcategory xannako lagi
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        //subcategory select huda sub_subcategory xanne wala ajax ko lagi
        Route::get('/sub_subcategory/ajax/{subcategory_id}', 'GetSubSubCategory');

        Route::post('/sub/sub/store', 'SubSubCategoryStore')->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', 'SubSubCategoryEdit')->name('subsubcategory.edit');
        Route::post('/sub/sub/update', 'SubSubCategoryUpdate')->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', 'SubSubCategoryDelete')->name('subsubcategory.delete');
    });



    //Admin Product All routes
    Route::prefix('product')->controller(ProductController::class)->group(function () { //product.delete 
        Route::get('/add', 'AddProduct')->name('add.product');
        Route::post('/store', 'ProductStore')->name('product.store');
        Route::get('/manage', 'ManageProduct')->name('manage.product');
        Route::get('/edit/{id}', 'EditProduct')->name('product.edit');
        Route::post('/data/update', 'ProductDataUpdate')->name('product.update');
        Route::post('/image/update', 'ProductMultiImageUpdate')->name('update.product.image');
        Route::post('/thumbnail/update', 'ProductThumbnailUpdate')->name('update.product.thumbnail');
        Route::get('/multiple/delete/{id}', 'MultiImageDelete')->name('product.multiimg.delete');
        Route::get('/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/delete/{id}', 'ProductDelete')->name('product.delete');
    });


    // Admin Slider all route
    Route::prefix('slider')->controller(SliderController::class)->group(function () { //slider.inactive
        Route::get('/view', 'SliderView')->name('manage.slider');
        Route::post('/store', 'SliderStore')->name('slider.store');
        Route::get('/edit/{id}', 'SliderEdit')->name('slider.edit');
        Route::post('/update', 'SliderUpdate')->name('slider.update');
        Route::get('/delete/{id}', 'SliderDelete')->name('slider.delete');
        Route::get('/active/{id}', 'SliderActive')->name('slider.active');
        Route::get('/inactive/{id}', 'SliderInactive')->name('slider.inactive');
    });
}); //middleware end




//user all route


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

// index all routes
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/user/logout', 'UserLogout')->name('user.logout');
    Route::get('/user/profile', 'UserProfile')->name('user.profile');
    Route::post('/user/profile/store', 'UserProfileStore')->name('user.profile.store');
    Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
    Route::post('/user/password/update', 'UserPasswordUpdate')->name('user.password.update');

    //product related product/tag/'.$tag->product_tags_nep  subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->sub_subcategory_slug_en
    Route::get('/product/details/{id}/{product_slug_en}', 'ProductDetails');
    Route::get('/product/tag/{tags}', 'TagWiseProduct');
    Route::get('/subcategory/product/{subcat_id}/{subcategory_slug}', 'SubCatWiseProduct');
    Route::get('/subsubcategory/product/{subsubcat_id}/{sub_subcategory_slug}', 'SubSubCatWiseProduct');

    //Product view modal with ajax /product/view/modal/'+id
    Route::get('/product/view/modal/{id}', 'ProductViewAjax');
});

/************ Multi Language All route**************/
Route::controller(LanguageController::class)->group(function () {
    Route::get('/language/nepali', 'Nepali')->name('nepali.language');
    Route::get('/language/english', 'English')->name('english.language');
});

///product/details/{id}

//Add to cart routes /cart/data/store/" + id, /minicart/product-remove/' + rowId 

Route::controller(CartController::class)->group(function () {

    Route::post('/cart/data/store/{product_id}', 'AddToCart');
    Route::get('/product/mini/cart', 'AddMiniCart');
    Route::get('/minicart/product-remove/{rowId}', 'RemoveMiniCartItem');
    Route::get('/add-to-wishlist/{product_id}', 'AddToWishlist');
    Route::get('/wishlist', 'Wishlist')->name('wishlist');
});


Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'App\Http\Controllers\User'], function () {
    //Wishlist all routes  /wishlist/product-remove/' + id,

    Route::controller(WishlistController::class)->group(function () {

        Route::get('/wishlist', 'Wishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProducts');
        Route::get('/wishlist/product-remove/{id}', 'RemoveProducts');
    });
});
