<?php



Route::group(['namespace' => 'Front'], function () {

    Route::get('/', 'HomeController@index')->name('front.home');
    Route::get('/buy', 'HomeController@storeTicket')->name('front.buy');
    Route::get('/list', 'HomeController@listOfTickets')->name('front.list');

});