<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 22/06/2020
 * Time: 11:06 AM
 */

Route::prefix('super-user')->group(function() {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('adminLoginForm');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('adminLogin');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('adminLogout');

    Route::get('spot-data', 'Admin\SpotController@indexData');
    Route::post('spot/create', 'Admin\SpotController@store');

    Route::get('accounts-data', 'Admin\AccountController@indexData');
    Route::post('accounts/create', 'Admin\AccountController@store');

    Route::post('save-image/{id}', 'Admin\GalleryController@saveImage');

    Route::get('/{vue_route_admin?}', 'Admin\HomeController@index')->where('vue_route_admin', '[\/\w\.-]*');
});
