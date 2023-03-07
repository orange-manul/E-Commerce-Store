<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;


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
    Route::controller(CategoryController::class)->group(function () {
        #All category
        Route::get('/admin/all-category', 'index')->name('all.category');
        #Add category
        Route::get('/admin/add-category', 'addCategory')->name('add.category');
        Route::post('/admin/store-category', 'storeCategory')->name('store.category');
        #Update category
        Route::get('/admin/edit-category/{id}', 'editCategory')->name('edit.category');
        Route::post('/admin/update-category', 'updateCategory')->name('update.category');
        #Delete category
        Route::get('/admin/delete-category/{id}', 'deleteCategory')->name('delete.category');
    });
    Route::controller(SubcategoryController::class)->group(function () {
        #All sub category
        Route::get('/admin/all-subcategory', 'index')->name('all.subcategory');
        #Add sub category
        Route::get('/admin/add-subcategory', 'addSubCategory')->name('add.subcategory');
        Route::post('/admin/store-subcategory', 'storeSubCategory')->name('store.subcategory');
        #Update sub category and using increment
        Route::get('/admin/edit-subcategory/{id}', 'editSubCategory')->name('edit.subcategory');
        Route::post('/admin/update-subcategory', 'updateSubCategory')->name('update.subcategory');
        #Delete sub category and using decrement
        Route::get('/admin/delete-subcategory/{id}', 'deleteSubCategory')->name('delete.subcategory');
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

