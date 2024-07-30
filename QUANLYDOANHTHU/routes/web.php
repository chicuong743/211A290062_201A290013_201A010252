<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\QL_Controller;
use Illuminate\Support\Facades\Route;


Route::get('/login',[loginController::class,'login'])->name('login');
Route::post('/checklogin', [loginController::class,'check_login']);
Route::middleware('auth')->group(function(){
    Route::get('/',[QL_Controller::class,'home'])->name('home');
    Route::get('/revenue-management', [QL_Controller::class, 'revenueManagement'])->name('revenue.index');
    Route::post('/revenue/filter', [QL_Controller::class, 'filterRevenue'])->name('revenue.filter');

    Route::get('/product/create',[QL_Controller::class,'add_product']);
    Route::post('/product/add',[QL_Controller::class,'uploadProduct']);
    Route::get('/product/edit/{id}',[QL_Controller::class,'edit_product']);
    Route::post('/product/edit/{id}',[QL_Controller::class,'updateProduct']);
    Route::get('/product/list', [QL_Controller::class,'list_product']);
    Route::get('/product/delete', [QL_Controller::class,'delete_product']);

    Route::get('/cart',[QL_Controller::class,'showCart']);
    Route::post('/cart/add', [QL_Controller::class, 'addToCart']);
    Route::post('/cart/checkout', [QL_Controller::class, 'checkout']);
    Route::post('/order/create', [QL_Controller::class, 'createOrder'])->name('order.create');
    Route::post('/cart/remove', [QL_Controller::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/order/list',[QL_Controller::class,'list_order']);
    Route::get('/order/{orderId}/detail', [QL_Controller::class, 'detail_order'])->name('order.detail');
});


