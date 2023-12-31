<?php

use Illuminate\Support\Facades\Route;
use Bkash\Dynamiccharging\Controllers\PaymentController;

Route::get('calc', function(){
    echo 'Hello from the Calc package!';
});
Route::get('token', [PaymentController::class, 'token']);
Route::get('CreatePayment', 'Bkash\Dynamiccharging\Controllers\PaymentController@CreatePayment')->name('CreatePayment');
Route::get('bkash_callback','Bkash\Dynamiccharging\Controllers\PaymentController@bkash_callback')->name('bkash_callback');
Route::get('queryPayment','Bkash\Dynamiccharging\Controllers\PaymentController@queryPayment')->name('queryPayment');
Route::get('refund','Bkash\Dynamiccharging\Controllers\PaymentController@refund')->name('refund');
Route::get('refundStatus','Bkash\Dynamiccharging\Controllers\PaymentController@refundStatus')->name('refundStatus');
Route::get('SearchTXN','Bkash\Dynamiccharging\Controllers\PaymentController@SearchTXN')->name('SearchTXN');

// Route::post('bkashCallback',[PaymentController::class@bkashCallback,'bkashCallback']);