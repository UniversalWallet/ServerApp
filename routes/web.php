<?php

Route::group(['namespace' => 'Front'], function () {

    Route::get('/', 'HomeController@index')->name('front.home');
    Route::get('/buy', 'HomeController@storeTicket')->name('front.buy');
    Route::get('/listAll', 'HomeController@listOfTickets')->name('front.listAll');
    Route::get('/listToVerify', 'HomeController@toVerify')->name('front.listUnVirified');
    Route::get('/verify', 'HomeController@verify')->name('front.verify');

});