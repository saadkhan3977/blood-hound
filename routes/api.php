<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\MessageSent;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get("/test",function(){
//         return "<h1>asdasd</h1>";
// });




Route::get('cron', [\App\Http\Controllers\Api\RegisterController::class, 'cron'])->name('cron');
Route::get('cron/plane', [\App\Http\Controllers\Api\RegisterController::class, 'cron_plane'])->name('cron_plane');

Route::post('register', [\App\Http\Controllers\Api\RegisterController::class, 'register']);
Route::get('noauth', [\App\Http\Controllers\Api\RegisterController::class, 'noauth'])->name('noauth');
 

Route::any('login', [\App\Http\Controllers\Api\RegisterController::class, 'login'])->name('login');
Route::any('verify', [\App\Http\Controllers\Api\RegisterController::class, 'verify']);
Route::post('password/email',  [\App\Http\Controllers\Api\ForgotPasswordController::class,'forget']);
Route::any('password/reset', [\App\Http\Controllers\Api\CodeCheckController::class,'index']);
Route::post('password/code/check', [\App\Http\Controllers\Api\CodeCheckController::class,'code_verify']);
// Route::get('guide', [\App\Http\Controllers\Api\CMSController::class, 'guide']);
// Route::get('term/conditions', [\App\Http\Controllers\Api\CMSController::class, 'termanscondition']);

Route::group(['middleware' => ['api','auth:api'], 'prefix' => 'auth'], function () 
{


    // Route::post('/message', function (Request $request) {
    //     // Create a dummy message for testing
    //     $message = [
    //         'chat_id' => $request->chat_id,
    //         'target_id' => $request->target_id,
    //         'text' => $request->text,
    //         'createdAt' => $request->createdAt,
    //         'user' => $request->user,
    //     ];
    
    //     // Broadcast the event
    //     broadcast(new MessageSent((object)$message))->toOthers();
    
    //     return response()->json(['status' => 'Message broadcasted']);
    // });

	Route::POST('send_message',[App\Http\Controllers\Api\MessageController::class,'sendMessage']);
	Route::get('chat_list',[App\Http\Controllers\Api\MessageController::class,'chat_list']);
	Route::get('message_list/{id}',[App\Http\Controllers\Api\MessageController::class,'message_list']);
	Route::get('product',[App\Http\Controllers\Api\ProductController::class,'index']);
    Route::post('profile', [\App\Http\Controllers\Api\UserController::class, 'profile']);  
	Route::resource('document',App\Http\Controllers\Api\DocumentController::class);
	Route::resource('pdf',App\Http\Controllers\Api\PDFController::class);
    
    Route::post('/donate', [App\Http\Controllers\Api\DonateController::class, 'store']);
    Route::post('/checkout', [App\Http\Controllers\Api\OrderController::class, 'store']);
    Route::get('/orders/list', [App\Http\Controllers\Api\OrderController::class, 'index']);

    // Route::post('review',[App\Http\Controllers\Api\UserController::class,'review']);
    // Route::get('review',[App\Http\Controllers\Api\UserController::class,'review_list']);
    Route::post('support',[App\Http\Controllers\Api\UserController::class,'support']);
    Route::post('user_status',[App\Http\Controllers\Api\UserController::class,'status_update']);
    Route::get('support',[App\Http\Controllers\Api\UserController::class,'support_list']);

    // Route::group(['prefix' => 'member'], function () {
	//     Route::resource('quote',App\Http\Controllers\Api\Member\QuoteController::class);
	//     Route::post('hiring/create',[App\Http\Controllers\Api\Member\QuoteController::class,'hiring_store']);
	//     Route::post('search',[App\Http\Controllers\Api\Member\QuoteController::class,'search']);
	//     Route::get('search_type/{id}',[App\Http\Controllers\Api\Member\QuoteController::class,'search_type']);
    //     route::post('update_status/{id}',[App\Http\Controllers\Api\Member\QuoteController::class,'update_status']);
    //     route::get('quote_ongoing',[App\Http\Controllers\Api\Member\QuoteController::class,'ongoing']);
    //     route::get('bid',[App\Http\Controllers\Api\Member\QuoteController::class,'bid_list']);
	//     Route::post('bid/{id}',[App\Http\Controllers\Api\Member\QuoteController::class,'bid_update']);
	//     Route::resource('bid_help',App\Http\Controllers\Api\Member\BidHelpController::class);
    //     route::get('negotiator',[App\Http\Controllers\Api\Member\QuoteController::class,'negotitator_list']);
    // });
    
    // Route::group(['prefix' => 'negotiator'], function () {
	//     Route::resource('bid',App\Http\Controllers\Api\Negotiator\BidController::class);
	//     Route::get('bid_help',[App\Http\Controllers\Api\Negotiator\BidController::class,'bid_help_list']);
	//     Route::post('search/{type}',[App\Http\Controllers\Api\Negotiator\BidController::class,'search']);
	//     Route::post('bid_help/{id}',[App\Http\Controllers\Api\Negotiator\BidController::class,'bid_help_update']);
    //     Route::get('quote/recommended',[App\Http\Controllers\Api\Negotiator\BidController::class,'quote_recommend_list']);
    //     Route::post('hiring/update/{id}',[App\Http\Controllers\Api\Negotiator\BidController::class,'hiring_update']);
	//     Route::get('hiring/list',[App\Http\Controllers\Api\Negotiator\BidController::class,'hiring_list']);
    //     Route::get('quote/complete',[App\Http\Controllers\Api\Negotiator\BidController::class,'quote_complete_list']);
    //     Route::get('quote_detail/{id}',[App\Http\Controllers\Api\Negotiator\BidController::class,'quote_detail']);
    //     Route::get('quote/working',[App\Http\Controllers\Api\Negotiator\BidController::class,'quote_working_list']);
	//     Route::post('profile_update',[App\Http\Controllers\Api\UserController::class,'negotiator_profile_update']);
	//     Route::post('photo_update',[App\Http\Controllers\Api\UserController::class,'negotiator_photo_update']);
	//     Route::post('coverphoto_update',[App\Http\Controllers\Api\UserController::class,'negotiator_coverphoto_update']);
    // });

    // Route::get('notification', [\App\Http\Controllers\Api\UserController::class, 'un_reead_notification']); 
    // Route::post('/notification',[\App\Http\Controllers\Api\UserController::class,'read_notification']);
    // Route::post('/checkout', [App\Http\Controllers\Api\OrderController::class, 'store']);
    // Route::get('shipping', [\App\Http\Controllers\Api\ShippingController::class, 'index']); 
    // Route::get('category', [\App\Http\Controllers\Api\CategoryController::class, 'index']); 
    // Route::get('brand', [\App\Http\Controllers\Api\BrandController::class, 'index']); 
    // Route::get('product', [\App\Http\Controllers\Api\ProductController::class, 'index']); 
    // Route::get('product/{brand}', [\App\Http\Controllers\Api\ProductController::class, 'brand_product']); 
	// Route::resource('cart',App\Http\Controllers\Api\CartController::class);
	
	// Route::resource('trophy',App\Http\Controllers\Api\TrophyController::class);
    // Route::post('set_goal', [\App\Http\Controllers\Api\GoalController::class, 'set_goal']); 
    // Route::get('goal/list', [\App\Http\Controllers\Api\GoalController::class, 'list']); 
    // Route::post('addcard', [\App\Http\Controllers\UserCardController::class, 'addcard']);
	// Route::post('updatecard', [\App\Http\Controllers\UserCardController::class, 'updatecard']); 
    // Route::get('me', [\App\Http\Controllers\Api\RegisterController::class, 'me']);
    Route::get('user', [\App\Http\Controllers\Api\RegisterController::class, 'user']);
    // Route::get('orders', [\App\Http\Controllers\Api\OrderController::class, 'orders']);
    // Route::get('children_orders', [\App\Http\Controllers\Api\OrderController::class, 'childorders']);
    // Route::post('order/{status}', [\App\Http\Controllers\Api\OrderController::class, 'orders_status']);
    // Route::get('transaction', [\App\Http\Controllers\TranasactionController::class, 'index']);
    // Route::post('withdraw', [\App\Http\Controllers\TranasactionController::class, 'store']);
    // Route::get('withdraw/list', [\App\Http\Controllers\TranasactionController::class, 'index']);
    Route::post('change_password', [\App\Http\Controllers\Api\RegisterController::class, 'change_password']); 
	// Route::post('cuurent/plan', [\App\Http\Controllers\Api\UserController::class, 'current_plan']);  	
    // Route::get('financial/breakdowns/{date}', [\App\Http\Controllers\Api\FinancialController::class, 'financialdata']);
    // Route::post('financial/breakdowns/post', [\App\Http\Controllers\Api\FinancialController::class, 'financialpost']);
    Route::get('admin/info', [\App\Http\Controllers\Api\ContactController::class, 'admininfo']);
    Route::post('contact/submit', [\App\Http\Controllers\Api\ContactController::class, 'contact_info']);
    Route::get('logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout']);
});
