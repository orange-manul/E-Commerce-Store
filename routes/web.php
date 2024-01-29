<?php

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\Category\AddCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\Category\StoreCategoryController;
use App\Http\Controllers\Admin\Category\UpdateCategoryController;

use App\Http\Controllers\Admin\SubCategory\AddSubCategoryController;
use App\Http\Controllers\Admin\SubCategory\DeleteSubCategoryController;
use App\Http\Controllers\Admin\SubCategory\EditSubCategoryController;
use App\Http\Controllers\Admin\SubCategory\IndexSubCategoryController;
use App\Http\Controllers\Admin\SubCategory\StoreSubCategoryController;
use App\Http\Controllers\Admin\SubCategory\UpdateSubCategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function (){
    Route::get('/', 'index')->name('index.home');
});

Route::controller(ClientController::class)->group(function (){
    Route::get('/category/{id}/{slug}', 'categoryPage')->name('category');
    Route::get('/product-details/{id}/{slug}', 'singleProduct')->name('single_product');
    Route::get('/new-release', 'newRelease')->name('new_release');
});

Route::middleware('auth', 'role:user')->group(function (){

    Route::controller(ClientController::class)->group(function (){
        Route::get('/add-to-cart', 'addToCart')->name('add_to_cart');
        Route::post('/add-product-to-cart', 'addProductToCart')->name('add_product_to_cart');
        Route::get('/shipping-address', 'getShippingAddress')->name('shipping_address');
        Route::post('/add-shipping-address', 'addShippingAddress')->name('add_shipping_address');
        Route::post('/place-order', 'placeOrder')->name('place_order');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/user-profile', 'userProfile')->name('user_profile');
        Route::get('/user-profile/pending-orders', 'pendingOrders')->name('pending_orders');
        Route::get('/user-profile/history', 'history')->name('history');
        Route::get('/new-release', 'newRelease')->name('new_release');
        Route::get('/todays-deal', 'todaysDeal')->name('todays_deal');
        Route::get('/custom-service', 'customService')->name('custom_service');
        Route::get('/remove-cart-item/{id}', 'removeCartItem')->name('remove_cart_item');
    });
});

#Dashboard authorization
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

#Admin panel
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });
    Route::group(['namespace' => 'App\Http\Controllers\Admin\Category'], function () {
        Route::get('/admin/all-category', IndexCategoryController::class,)->name('all.category');
        Route::get('/admin/add-category', AddCategoryController::class)->name('add.category');
        Route::post('/admin/store-category', StoreCategoryController::class)->name('store.category');
        Route::post('/admin/update-category', UpdateCategoryController::class)->name('update.category');
        Route::get('/admin/edit-category/{id}', EditCategoryController::class)->name('edit.category');
        Route::get('/admin/delete-category/{id}', DeleteCategoryController::class)->name('delete.category');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Admin\SubCategory'], function () {
        #All sub category
        Route::get('/admin/all-subcategory', IndexSubCategoryController::class)->name('all.subcategory');
        #Add sub category
        Route::get('/admin/add-subcategory', AddSubCategoryController::class)->name('add.subcategory');
        Route::post('/admin/store-subcategory', StoreSubCategoryController::class)->name('store.subcategory');
        #Update sub category and using increment
        Route::get('/admin/edit-subcategory/{id}', EditSubCategoryController::class)->name('edit.subcategory');
        Route::post('/admin/update-subcategory', UpdateSubCategoryController::class)->name('update.subcategory');
        #Delete sub category and using decrement
        Route::get('/admin/delete-subcategory/{id}', DeleteSubCategoryController::class)->name('delete.subcategory');
    });
    Route::controller(ProductController::class)->group(function () {
        #All product
        Route::get('/admin/all-products', 'index')->name('all.product');
        #Add product
        Route::get('/admin/add-product', 'addProduct')->name('add.product');
        Route::post('/admin/store-product', 'storeProduct')->name('store.product');
        #Edit product
        Route::get('/admin/edit-product/{id}', 'editProduct')->name('edit.product');
        Route::post('/admin/update-product', 'updateProduct')->name('update.product');
        # Product image edit
        Route::get('/admin/edit-product-img/{id}', 'editProductImg')->name('edit.product_img');
        Route::post('/admin/update-product-img', 'updateProductImg')->name('update.product_img');
        #Delete product
        Route::get('admin/delete-product/{id}', 'deleteProduct')->name('delete.product');

    });


    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'index')->name('pending.order');
    });

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

