<?php

use Illuminate\Support\Facades\Route;

// Products Routes
Route::get('/', 'ProductsController@index')->name('products.index');
Route::get('/products/{id}', 'ProductsController@show')->name('products.show');

/* Cart Routes */
Route::post('/cart/add','CartController@store')->name('cart.store');
Route::get('/emptyCart', function(){
    Cart::destroy();
    return redirect()->route('products.index');
});
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');

/* Checkout Routes */
Route::get('/checkout','CheckoutController@index')->name('checkout.index');
Route::post('/checkout','CheckoutController@store')->name('checkout.store');
Route::get('/thanks', function(){
    return view('checkout.thanks');
});