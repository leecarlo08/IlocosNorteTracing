<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 22/06/2020
 * Time: 11:06 AM
 */

Route::post('log-tourist/{token}', 'SiteOfficer\LogController@logTourist');

Route::prefix('site-officer')->group(function(){
    Route::get('login', 'SiteOfficer\Auth\LoginController@showloginForm')->name('spotForm');
    Route::post('login', 'SiteOfficer\Auth\LoginController@login');
    Route::post('logout', 'SiteOfficer\Auth\LoginController@logout');

    Route::get('get-announcements', 'SiteOfficer\AnnouncementController@getAnnouncements');
    Route::get('announcement-data/{id}', 'SiteOfficer\AnnouncementController@announcementData');

    Route::get('get-logs', 'SiteOfficer\LogController@getSiteLogs');
    Route::get('site-info', 'SiteOfficer\HomeController@getSiteInfo');

    Route::get('/{vue_route_spot?}', 'SiteOfficer\HomeController@index')->where('vue_route_spot', '[\/\w\.-]*');
});
