<?php

/**
 * All route names are prefixed with 'admin.'.
 */

/**
* Routes for banner
*/
Route::resource('banner', 'Banner\BannerController', ['except' => ['show']]);

Route::group(['namespace' => 'Banner'], function () {
    Route::post('banner/get', 'TableController')->name('banner.get');	
});