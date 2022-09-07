<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripController;
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


    // Admin Slider all route manage.coupon
    Route::prefix('slider')->controller(SliderController::class)->group(function () { //slider.inactive
        Route::get('/view', 'SliderView')->name('manage.slider');
        Route::post('/store', 'SliderStore')->name('slider.store');
        Route::get('/edit/{id}', 'SliderEdit')->name('slider.edit');
        Route::post('/update', 'SliderUpdate')->name('slider.update');
        Route::get('/delete/{id}', 'SliderDelete')->name('slider.delete');
        Route::get('/active/{id}', 'SliderActive')->name('slider.active');
        Route::get('/inactive/{id}', 'SliderInactive')->name('slider.inactive');
    });

    //Admin Coupon all routes... manage.province
    Route::prefix('coupon')->controller(CouponController::class)->group(function () { //slider.inactive
        Route::get('/view', 'CouponView')->name('manage.coupon');
        Route::post('/store', 'CouponStore')->name('coupon.store');
        Route::get('/edit/{id}', 'CouponEdit')->name('coupon.edit');
        Route::post('/update/{id}', 'CouponUpdate')->name('coupon.update');
        Route::get('/delete/{id}', 'CouponDelete')->name('coupon.delete');
        Route::get('/active/{id}', 'CouponActive')->name('coupon.active');
        Route::get('/inactive/{id}', 'CouponInactive')->name('coupon.inactive');
    });


    //Admin Shipping all routes... 
    Route::prefix('shipping')->controller(ShippingController::class)->group(function () { //manage.district
        Route::get('/province/view', 'ProvinceView')->name('manage.province');
        Route::post('/province/store', 'ProvinceStore')->name('province.store');
        Route::get('/province/edit/{id}', 'ProvinceEdit')->name('province.edit');
        Route::post('/province/update', 'ProvinceUpdate')->name('province.update');
        Route::get('/province/delete/{id}', 'ProvinceDelete')->name('province.delete');

        //Admin shipping District all routes 
        Route::get('/district/view', 'DistrictView')->name('manage.district');
        Route::post('/district/store', 'DistrictStore')->name('district.store');
        Route::get('/district/edit/{id}', 'DistrictEdit')->name('district.edit');
        Route::post('/district/update', 'DistrictUpdate')->name('district.update');
        Route::get('/district/delete/{id}', 'DistrictDelete')->name('district.delete');

        //Admin shipping gaupalika ra nagarpalika all routes 
        Route::get('/municipality/view', 'MunicipalityView')->name('manage.municipality');
        Route::post('/municipal/store', 'MunicipalStore')->name('municipal.store'); ///province/district/ajax
        Route::get('/municipal/edit/{id}', 'MunicipalEdit')->name('municipal.edit');
        Route::post('/municipal/update', 'MunicipalUpdate')->name('municipal.update');
        Route::get('/municipal/delete/{id}', 'MunicipalDelete')->name('municipal.delete');


        //province select huda district xannako lagi
        Route::get('/district/ajax/{province_id}', 'GetDistrict');
    });

    // Admin Orders All routes confirmed
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/pending', 'PendingOrders')->name('pending.orders');
        Route::get('/pending/order/details/{order_id}', 'PendingOrderDetails')->name('pending.order.details');
        Route::get('/confirmed', 'ConfirmedOrders')->name('confirmed.orders');
        Route::get('/processing', 'ProcessingOrders')->name('processing.orders');
        Route::get('/picked', 'PickedOrders')->name('picked.orders'); //delivered
        Route::get('/shipped', 'ShippedOrders')->name('shipped.orders'); //
        Route::get('/delivered', 'DeliveredOrders')->name('delivered.orders'); //
        Route::get('/canceled', 'CanceledOrders')->name('canceled.orders'); //pending-confirm

        Route::get('/pending-confirm/{order_id}', 'PendingToConfirmed')->name('pending-confirm'); //processing-order
        Route::get('/processing-order/{order_id}', 'ConfirmedToProcessing')->name('processing-order'); //
        Route::get('/processing-picked/{order_id}', 'ProcessingToPicked')->name('processing.picked'); //
        Route::get('/picked-shipped/{order_id}', 'PickedToShipped')->name('picked.shipped'); //
        Route::get('/shipped-delivered/{order_id}', 'ShippedToDelivered')->name('shipped.delivered'); //
        Route::get('/admin-invoice-download/{order_id}', 'AdminInvoiceDownload')->name('invoice.download');
    });
    //

    // Admin Reports All routes 
    Route::prefix('reports')->controller(ReportController::class)->group(function () {
        Route::get('/view', 'ReportView')->name('all.reports'); //search-by-date
        Route::post('/search/by/date', 'ReportByDate')->name('search-by-date'); //search-by-month
        Route::post('/search/by/month', 'ReportByMonth')->name('search-by-month'); //report-by-year
        Route::post('/search/by/year', 'ReportByYear')->name('report-by-year'); //
    });

    // Admin user All routes 
    Route::prefix('alluser')->controller(AdminProfileController::class)->group(function () {
        Route::get('/view', 'AllUsers')->name('all.users'); //search-by-date

    });

    // Admin Blog All routes 
    Route::prefix('blog')->controller(BlogController::class)->group(function () {
        Route::get('/category', 'BlogCategory')->name('blog.category');
        Route::post('/category/store', 'BlogCategoryStore')->name('blogcategory.store');
        Route::get('/category/edit/{id}', 'BlogCategoryEdit')->name('blogcategory.edit');
        Route::post('/category/update', 'BlogCategoryUpdate')->name('blogcategory.update');
        Route::get('/category/delete/{id}', 'BlogCategoryDelete')->name('blogcategory.delete');



        //view.post Blog Post All Routes
        Route::get('/view/post', 'ViewBlogPost')->name('view.post');
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

    //Coupon apply routes /apply-coupon 
    Route::post('/apply-coupon', 'CouponApply');
    Route::get('/coupon-calculation', 'CouponCalculation');
    Route::get('/coupon-remove', 'CouponRemove');

    //checkout
    /************START: Checkout All routes*****************/
    ///checkout/district-get/ajax

    Route::get('/checkout', 'CheckoutCreate')->name('checkout');

    /************END: Checkout All routes*****************/
});

Route::controller(CheckoutController::class)->group(function () {



    /************START: Checkout All routes however, CheckoutCreate chai CartController ma xa hai*****************/
    ///checkout/district-get/ajax  

    Route::get('/checkout/district-get/ajax/{province_id}', 'DistrictGetAjax');
    Route::get('/checkout/municipals-get/ajax/{district_id}', 'MunicipalsGetAjax');

    Route::post('/checkouts/store', 'CheckoutStore')->name('checkout.store');


    /************END: Checkout All routes*****************/
});





Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'App\Http\Controllers\User'], function () {
    //Wishlist all routes  /wishlist/product-remove/' + id,  

    Route::controller(WishlistController::class)->group(function () {

        Route::get('/wishlist', 'Wishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProducts');
        Route::get('/wishlist/product-remove/{id}', 'RemoveProducts');
    });

    //Strip Payment related routes....strip.order


    Route::controller(StripController::class)->group(function () {
        Route::post('/strip/order', 'StripOrder')->name('strip.order');
    });

    //Cash on Delivery routes
    Route::controller(CashController::class)->group(function () {
        Route::post('/cash/order', 'CashOrder')->name('cash.order');
    });


    //my.orders


    Route::controller(AllUserController::class)->group(function () {
        Route::get('/my/orders', 'MyOrders')->name('my.orders'); ///user/order_details'.$order->id
        Route::get('/order_details/{order_id}', 'OrderDetails'); ///user/order_details'.$order->id /user/
        Route::get('/invoice-download/{order_id}', 'InvoiceDownload'); //return.order
        Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order'); //
        Route::get('/return/orders-list', 'ReturnOrdersList')->name('return.orders.list'); //cancel.orders.list
        Route::get('/cancel/orders-list', 'CancelOrdersList')->name('cancel.orders.list'); //

    });
});

//guest le cart page herna milna ko lagi middleware group bata bahira rakheko
//All Mycart page routes cart/product-remove/  + id, 

Route::controller(CartPageController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-mycart-product', 'GetCartProducts');
    Route::get('/cart/product-remove/{id}', 'CartProductRemove');
    Route::get('/cart-increment/{id}', 'CartIncrement');
    Route::get('/cart-decrement/{id}', 'CartDecrement');
});
