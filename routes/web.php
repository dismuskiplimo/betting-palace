<?php

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

Route::get('/', "FrontController@getIndexPage")->name("homepage");

Route::get('/dashboard', 'BackController@dashboard')->name('dashboard');

//Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard'); 

    Route::get('/users/{category}', 'AdminController@getUsers')->name('admin.users'); 
    Route::get('/predictions/{category}', 'AdminController@getPredictions')->name('admin.predictions'); 
    Route::get('/bet-groups/{category}', 'AdminController@getBetGroups')->name('admin.bet-groups'); 
    Route::get('/subscriptions/{category}', 'AdminController@getSubscriptions')->name('admin.subscriptions'); 
    Route::get('/sms-subscriptions/{category}', 'AdminController@getSmsSubscriptions')->name('admin.sms-subscriptions'); 
    Route::get('/transactions/{category}', 'AdminController@getTransactions')->name('admin.transactions'); 
    Route::get('/site-settings', 'AdminController@getSiteSettings')->name('admin.site-settings'); 

    Route::get('/settings', 'AdminController@getSettings')->name('admin.settings');
    Route::post('/settings', 'AdminController@postSettings');

    Route::post('/user/add', 'AdminController@postAddUser')->name('admin.add-user');
});

// Standard User Routes
Route::prefix('standard-user')->group(function () {
    Route::get('/dashboard', 'StandardUserController@dashboard')->name('standard-user.dashboard');
    
    Route::get('/history', 'StandardUserController@getHistory')->name('standard-user.history');

    Route::get('/subscriptions', 'StandardUserController@getSubscriptions')->name('standard-user.subscriptions');
    
    Route::get('/settings', 'StandardUserController@getSettings')->name('standard-user.settings');
    Route::post('/settings', 'StandardUserController@postSettings');
});

// Analyst Routes
Route::prefix('analyst')->group(function () {
    Route::get('/dashboard', 'AnalystController@dashboard')->name('analyst.dashboard');
    Route::post('/dashboard', 'AnalystController@postAddBet'); 
    Route::post('/bet/{id}/update', 'AnalystController@updateBet')->name('analyst.bet.update');
    Route::post('/bet/{id}/delete', 'AnalystController@deleteBet')->name('analyst.bet.delete');
    Route::post('/betslip/{id}/delete', 'AnalystController@deleteBetGroup')->name('analyst.betslip.delete'); 


    Route::post('/dashboard/betslip/add', 'AnalystController@postAddBetToBetslip')->name('analyst.betslip.add');
    Route::post('/dashboard/sms/send', 'AnalystController@postSendSms')->name('analyst.sms.send'); 

    Route::get('/settings', 'AnalystController@getSettings')->name('analyst.settings');
    Route::post('/settings', 'AnalystController@postSettings');
});

// Back Controller
Route::post('/subscription/predictions/make', 'BackController@postMakePredictionsSubscription')->name('subscription.predictions.make');
Route::post('/subscription/sms/make', 'BackController@postMakeSMSSubscription')->name('subscription.sms.make'); 

Route::post('/subscription/{type}/request/payment/mpesa', 'PaymentController@requestMpesaPayment')->name('payment.request.mpesa');
Route::post('/subscription/{type}/{value}/{user_id}/process/payment/mpesa', 'PaymentController@processMpesaRequest')->name('payment.process.mpesa');
Route::post('/password/update', 'BackController@postUpdatePassword')->name('auth.password.update');

// Auth Routes
Auth::routes();

Route::get('logout', function(){
    auth()->logout();
    session()->flash('success', 'Logged out');
    return redirect()->route('login');
});


