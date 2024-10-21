<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaypalController;

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

Route::get('payment-paypal', [PaypalController::class,'postPaymentWithpaypal'])->name('payment-paypal')->middleware('auth');
Route::get('status', [PaypalController::class,'getPaymentStatus'])->name('status')->middleware('auth');

Route::get('/product-grids',[FrontendController::class,'productGrids'])->name('product-grids');

Auth::routes(['register'=>false]);

Route::get('saad',[FrontendController::class,'calculator']);
Route::get('user/login',[FrontendController::class,'login'])->name('login.form');
Route::post('user/login',[FrontendController::class,'loginSubmit'])->name('login.submit');
Route::get('user/logout',[FrontendController::class,'logout'])->name('user.logout');


Route::get('user/register',[FrontendController::class,'register'])->name('register.form');
Route::post('user/register',[FrontendController::class,'registerSubmit'])->name('register.submit');

Route::get('vendor/login',[LoginController::class,'vendor_login'])->name('vendor_login.form');
Route::post('vendor/login',[LoginController::class,'vendor_login_submit'])->name('vendor.login');
Route::post('vendor/register',[FrontendController::class,'vendorregisterSubmit'])->name('vendor_register.submit');
// Reset password
// Route::post('password-reset', [FrontendController::class,'showResetForm'])->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', [\App\Http\Controllers\Auth\LoginController::class,'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback/', [\App\Http\Controllers\Auth\LoginController::class,'Callback'])->name('login.callback');

Route::get('/',[FrontendController::class,'home'])->name('home');

// Frontend Routes
Route::get('/home', [FrontendController::class,'index']);
Route::get('/terms', [FrontendController::class,'terms'])->name('terms');
Route::get('/privacy-policy', [FrontendController::class,'privacy_policy'])->name('privacy-policy');
Route::get('/about-us',[FrontendController::class,'aboutUs'])->name('about-us');
Route::get('/how-to-use',[FrontendController::class,'howtouse'])->name('how-to-use');
Route::get('/commerce-policy',[FrontendController::class,'commerce_policy'])->name('commerce-policy');
Route::get('/dispute-policy',[FrontendController::class,'dispute_policy'])->name('dispute-policy');
Route::get('/fee-schedule',[FrontendController::class,'fee_schedule'])->name('fee-schedule');
Route::get('/postage-label-terms',[FrontendController::class,'postage_label_terms'])->name('postage-label-terms');
Route::get('/FAQ',[FrontendController::class,'faqs'])->name('FAQ');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/productqa/store',[FrontendController::class,'product_qa_store'])->name('productqa.store');
Route::post('/contact/message',[\App\Http\Controllers\MessageController::class,'store'])->name('contact.store');
Route::get('product-detail/{slug}',[FrontendController::class,'productDetail'])->name('product-detail');
Route::get('/product-review-fetch/{slug}/{id}',[FrontendController::class,'product_review_fetch'])->name('product-review-fetch');
Route::post('/product/search',[FrontendController::class,'productSearch'])->name('product.search');
Route::get('/product-cat/{slug}',[FrontendController::class,'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}',[FrontendController::class,'productSubCat'])->name('product-sub-cat');
Route::get('/product-brand/{slug}',[FrontendController::class,'productBrand'])->name('product-brand');
// Cart section
Route::get('/add-to-cart/{slug}',[\App\Http\Controllers\CartController::class,'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart',[\App\Http\Controllers\CartController::class,'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}',[\App\Http\Controllers\CartController::class,'cartDelete'])->name('cart-delete');
Route::post('cart-update',[\App\Http\Controllers\CartController::class,'cartUpdate'])->name('cart.update');

Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout',[\App\Http\Controllers\CartController::class,'checkout'])->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}',[\App\Http\Controllers\WishlistController::class,'wishlist'])->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}',[\App\Http\Controllers\WishlistController::class,'wishlistDelete'])->name('wishlist-delete');
Route::post('cart/order',[\App\Http\Controllers\OrderController::class,'store'])->name('cart.order');
Route::get('order/pdf/{id}',[\App\Http\Controllers\OrdersController::class,'pdf'])->name('order.pdf');
Route::get('/income',[\App\Http\Controllers\OrdersController::class,'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[\App\Http\Controllers\AdminController::class,'userPieChart'])->name('user.piechart');
Route::get('/product-lists',[FrontendController::class,'productLists'])->name('product-lists');
Route::match(['get','post'],'/filter',[FrontendController::class,'productFilter'])->name('shop.filter');
// Order Track
Route::get('/product/track',[\App\Http\Controllers\OrderController::class,'orderTrack'])->name('order.track');
Route::post('product/track/order',[\App\Http\Controllers\OrderController::class,'productTrackOrder'])->name('product.track.order');
// Blog
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/blog-detail/{slug}',[FrontendController::class,'blogDetail'])->name('blog.detail');
Route::get('/blog/search',[FrontendController::class,'blogSearch'])->name('blog.search');
Route::post('/blog/filter',[FrontendController::class,'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}',[FrontendController::class,'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}',[FrontendController::class,'blogByTag'])->name('blog.tag');

// NewsLetter
Route::post('/subscribe',[FrontendController::class,'subscribe'])->name('subscribe');

// Product Review
Route::resource('/review',\App\Http\Controllers\ProductReviewController::class);
// Route::post('product/{slug}/review',[\App\Http\Controllers\ProductReviewController::class,'store'])->name('review.store');
Route::post('vendor/{slug}/review',[\App\Http\Controllers\ProductReviewController::class,'vendor_store'])->name('vendor_review.store');

// Post Comment 
Route::post('post/{slug}/comment',[\App\Http\Controllers\PostCommentController::class,'store'])->name('post-comment.store');
Route::resource('/comment',\App\Http\Controllers\PostCommentController::class);
// Coupon
Route::post('/coupon-store',[\App\Http\Controllers\CouponController::class,'couponStore'])->name('coupon-store');
// Payment
Route::get('payment', [\App\Http\Controllers\PayPalController::class,'payment'])->name('payment');
Route::get('cancel', [\App\Http\Controllers\PayPalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [\App\Http\Controllers\PayPalController::class,'success'])->name('payment.success');



// Backend section start

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\AdminController::class,'index'])->name('admin.dashboard');
    
    Route::get('/donations', [App\Http\Controllers\AdminController::class,'donations'])->name('donations.index');

    // user route
    Route::resource('users',\App\Http\Controllers\UsersController::class);
    // vendor route
    Route::resource('vendors',\App\Http\Controllers\VendorsController::class);
    // Banner
    Route::resource('banner',App\Http\Controllers\BannerController::class);
    // Brand
    Route::resource('brand',\App\Http\Controllers\BrandController::class);
    // Profile
    Route::get('/profile',[\App\Http\Controllers\AdminController::class,'profile'])->name('admin.profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\AdminController::class,'profileUpdate'])->name('profile-update');
    // Category
    Route::resource('/category',\App\Http\Controllers\CategoryController::class);
    // Product
    Route::resource('/product',\App\Http\Controllers\ProductController::class);
    // Ajax for sub category
    Route::post('/category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParent']);
    // POST category
    Route::resource('/post-category',\App\Http\Controllers\PostCategoryController::class);
    // Post tag
    Route::resource('/post-tag',\App\Http\Controllers\PostTagController::class);
    // Post
    Route::resource('/post',\App\Http\Controllers\PostController::class);
    // Message
    Route::resource('/message',\App\Http\Controllers\MessageController::class);
    Route::get('/message/five',[\App\Http\Controllers\MessageController::class,'messageFive'])->name('messages.five');

    // Order
    Route::resource('/order',\App\Http\Controllers\OrdersController::class);
    // Shipping
    Route::resource('/shipping',\App\Http\Controllers\ShippingController::class);
    // Coupon
    Route::resource('/coupon',\App\Http\Controllers\CouponController::class);
    // Settings
    Route::get('settings',[\App\Http\Controllers\AdminController::class,'settings'])->name('settings');
    Route::post('setting/update',[\App\Http\Controllers\AdminController::class,'settingsUpdate'])->name('settings.update');

    // Notification
    Route::get('/notification/{id}',[\App\Http\Controllers\NotificationController::class,'show'])->name('admin.notification');
    Route::get('/notifications',[\App\Http\Controllers\NotificationController::class,'index'])->name('all.notification');
    Route::delete('/notification/{id}',[\App\Http\Controllers\NotificationController::class,'delete'])->name('notification.delete');
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\AdminController::class,'changePassword'])->name('change.password.form');
    Route::post('change-password', [\App\Http\Controllers\AdminController::class,'changPasswordStore'])->name('change.password');
});






// Vendor
// Route::group(['prefix'=>'/vendor','middleware'=>['auth','vendor']],function(){
//     Route::get('/dashboard',[\App\Http\Controllers\Vendor\DashboardController::class,'index'])->name('vendor.dashboard');
//     // Product
//     Route::resource('/vproduct',\App\Http\Controllers\Vendor\ProductController::class);
//     Route::get('/vproductqa',[\App\Http\Controllers\Vendor\ProductQAController::class,'index'])->name('vproductqa.index');
//     Route::get('/vproductqa/edit/{id}',[\App\Http\Controllers\Vendor\ProductQAController::class,'edit'])->name('vproductqa.edit');
//     Route::put('/vproductqa/update/{id}',[\App\Http\Controllers\Vendor\ProductQAController::class,'update'])->name('vproductqa.update');
//     // Order
//     // Route::resource('/order',\App\Http\Controllers\Vendor\OrderController::class);
//     Route::get('order/pdf/{id}',[\App\Http\Controllers\Vendor\OrderController::class,'pdf'])->name('vorder.pdf');

//     // Profile
//     Route::get('/profile',[\App\Http\Controllers\Vendor\VendorController::class,'profile'])->name('vendor.profile');
//     Route::post('/profile/{id}',[\App\Http\Controllers\Vendor\VendorController::class,'profileUpdate'])->name('vendor-profile-update');

// });

// User section start
Route::group(['prefix'=>'/user','middleware'=>['auth','user']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\HomeController::class,'index'])->name('user');
    
    // Profile
     Route::get('/profile',[\App\Http\Controllers\HomeController::class,'profile'])->name('user-profile');
     Route::post('/profile/{id}',[\App\Http\Controllers\HomeController::class,'profileUpdate'])->name('user-profile-update');
    
     //  Order
    Route::get('/order',[\App\Http\Controllers\HomeController::class,'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}',[\App\Http\Controllers\HomeController::class,"orderShow"])->name('user.order.show');
    Route::delete('/order/delete/{id}',[\App\Http\Controllers\HomeController::class,'userOrderDelete'])->name('user.order.delete');
    
    // Product Review
    Route::get('/user-review',[\App\Http\Controllers\HomeController::class,'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}',[\App\Http\Controllers\HomeController::class,'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}',[\App\Http\Controllers\HomeController::class,'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}',[\App\Http\Controllers\HomeController::class,'productReviewUpdate'])->name('user.productreview.update');
    
    // Post comment
    Route::get('user-post/comment',[\App\Http\Controllers\HomeController::class,'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}',[\App\Http\Controllers\HomeController::class,'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}',[\App\Http\Controllers\HomeController::class,'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}',[\App\Http\Controllers\HomeController::class,'userCommentUpdate'])->name('user.post-comment.update');
    
    // Password Change
    // Route::get('change-password', [\App\Http\Controllers\HomeController::class,'changePassword'])->name('user.change.password.form');
    // Route::post('change-password', [\App\Http\Controllers\HomeController::class,'changPasswordStore'])->name('change.password');

});
Route::get('/file-manager',function(){
    return view('backend.layouts.file-manager');
})->name('file-manager');


// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });