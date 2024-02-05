<?php

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\Category\AddCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\Category\StoreCategoryController;
use App\Http\Controllers\Admin\Category\UpdateCategoryController;

use App\Http\Controllers\Admin\Order\OrderController;

use App\Http\Controllers\Admin\Product\AddProductController;
use App\Http\Controllers\Admin\Product\DeleteProductController;
use App\Http\Controllers\Admin\Product\EditProductController;
use App\Http\Controllers\Admin\Product\EditProductImageController;
use App\Http\Controllers\Admin\Product\IndexProductController;
use App\Http\Controllers\Admin\Product\StoreProductController;
use App\Http\Controllers\Admin\Product\UpdateProductController;
use App\Http\Controllers\Admin\Product\UpdateProductImageController;

use App\Http\Controllers\Admin\SubCategory\AddSubcategoryController;
use App\Http\Controllers\Admin\SubCategory\DeleteSubcategoryController;
use App\Http\Controllers\Admin\SubCategory\EditSubcategoryController;
use App\Http\Controllers\Admin\SubCategory\IndexSubcategoryController;
use App\Http\Controllers\Admin\SubCategory\StoreSubcategoryController;
use App\Http\Controllers\Admin\SubCategory\UpdateSubcategoryController;

use App\Http\Controllers\Client\Address\AddShippingAddressController;
use App\Http\Controllers\Client\Address\GetShippingAddres;

use App\Http\Controllers\Client\Cart\AddProductToCartController;
use App\Http\Controllers\Client\Cart\AddToCartController;
use App\Http\Controllers\Client\Cart\RemoveCartItemController;

use App\Http\Controllers\Client\Order\CheckoutController;
use App\Http\Controllers\Client\Order\HistoryController;
use App\Http\Controllers\Client\Order\PendingOrderController;
use App\Http\Controllers\Client\Order\PlaceOrderController;

use App\Http\Controllers\Client\Page\CategoryPageController;
use App\Http\Controllers\Client\Page\CustomServiceController;
use App\Http\Controllers\Client\Page\NewReleaseController;
use App\Http\Controllers\Client\Page\SingleProductController;
use App\Http\Controllers\Client\Page\TodayDealController;
use App\Http\Controllers\Client\Profile\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function (){
    Route::get('/', 'index')->name('index.home');
});

Route::group(['namespace' => 'App\Http\Controllers\Client\Page'], function (){
    Route::get('/category/{id}/{slug}', CategoryPageController::class)->name('category');
    Route::get('/product-details/{id}/{slug}', SingleProductController::class)->name('single_product');
});

Route::middleware('auth', 'role:user|admin')->group(function () {

    Route::group(['namespace' => 'App\Http\Controllers\Client'], function () {
        Route::group(['namespace' => 'Cart'], function () {
            Route::get('/add-to-cart', AddToCartController::class)->name('add_to_cart');
            Route::post('/add-product-to-cart', AddProductToCartController::class)->name('add_product_to_cart');
            Route::get('/remove-cart-item/{id}', RemoveCartItemController::class)->name('remove_cart_item');
        });

        Route::get('/shipping-address', GetShippingAddres::class)->name('shipping_address');
        Route::post('/add-shipping-address', AddShippingAddressController::class)->name('add_shipping_address');

        Route::group(['namespace' => 'Order'], function (){
            Route::post('/place-order', PlaceOrderController::class)->name('place_order');
            Route::get('/checkout', CheckoutController::class)->name('checkout');
            Route::get('/user-profile/pending-orders', PendingOrderController::class)->name('pending_orders');
            Route::get('/user-profile/history', HistoryController::class)->name('history');
        });

        Route::group(['namespace' => 'Profile'], function(){
            Route::get('/user-profile', ProfileController::class)->name('user_profile');
        });

        Route::group(['namespace' => 'Page'], function (){
            Route::get('/new-release', NewReleaseController::class)->name('new_release');
            Route::get('/todays-deal', TodayDealController::class)->name('todays_deal');
            Route::get('/custom-service', CustomServiceController::class)->name('custom_service');

        });
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
            #create category
            Route::get('/admin/add-category', AddCategoryController::class)->name('add.category');
            Route::post('/admin/store-category', StoreCategoryController::class)->name('store.category');
            #update category
            Route::get('/admin/edit-category/{id}', EditCategoryController::class)->name('edit.category');
            Route::post('/admin/update-category', UpdateCategoryController::class)->name('update.category');
            #delete category
            Route::get('/admin/delete-category/{id}', DeleteCategoryController::class)->name('delete.category');
        });

        Route::group(['namespace' => 'App\Http\Controllers\Admin\SubCategory'], function () {
            #All sub category
            Route::get('/admin/all-subcategory', IndexSubcategoryController::class)->name('all.subcategory');
            #Add sub category
            Route::get('/admin/add-subcategory', AddSubcategoryController::class)->name('add.subcategory');
            Route::post('/admin/store-subcategory', StoreSubcategoryController::class)->name('store.subcategory');
            #Update sub category and using increment
            Route::get('/admin/edit-subcategory/{id}', EditSubcategoryController::class)->name('edit.subcategory');
            Route::post('/admin/update-subcategory', UpdateSubcategoryController::class)->name('update.subcategory');
            #Delete sub category and using decrement
            Route::get('/admin/delete-subcategory/{id}', DeleteSubcategoryController::class)->name('delete.subcategory');
        });

        Route::group(['namespace' => 'App\Http\Controllers\Admin\Product'], function () {
            #All product
            Route::get('/admin/all-products', IndexProductController::class)->name('all.product');
            #Add product
            Route::get('/admin/add-product', AddProductController::class)->name('add.product');
            Route::post('/admin/store-product', StoreProductController::class)->name('store.product');
            #Edit product
            Route::get('/admin/edit-product/{id}', EditProductController::class)->name('edit.product');
            Route::post('/admin/update-product/', UpdateProductController::class)->name('update.product');
            # Product image edit
            Route::get('/admin/edit-product-img/{id}', EditProductImageController::class)->name('edit.product_img');
            Route::post('/admin/update-product-img', UpdateProductImageController::class)->name('update.product_img');
            #Delete product
            Route::get('admin/delete-product/{id}', DeleteProductController::class)->name('delete.product');

        });

        Route::group(['namespace' => 'App\Http\Controllers\Admin\Order'], function () {
            Route::get('/admin/pending-order', OrderController::class)->name('pending.order');
        });

    });


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';


