<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
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
    })->name('dashboard');
});

// Admin All routes
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
// Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile'); all.brand

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
});






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

//Route::get('/admin/logout', [IndexController::class, 'index'])->name('admin.logout'); 
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/user/logout', 'UserLogout')->name('user.logout');
    Route::get('/user/profile', 'UserProfile')->name('user.profile');
    Route::post('/user/profile/store', 'UserProfileStore')->name('user.profile.store');
    Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
    Route::post('/user/password/update', 'UserPasswordUpdate')->name('user.password.update');
});
