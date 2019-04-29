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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');

Auth::routes();

// Authentication Routes...
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login', 'Auth\LoginController@login');
    // Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
    // Route::resetPassword();

// Email Verification Routes...
    // Route::emailVerification();

Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    Route::group(['prefix' => 'participants'], function () {
        Route::post('/', 'Admin\ParticipantController@store');
        Route::post('/tesphoto', 'Admin\ParticipantController@tes');
        Route::get('/all', 'Admin\ParticipantController@index_all');
        Route::get('/unregistered', 'Admin\ParticipantController@index_unregistered');
        Route::get('/registered', 'Admin\ParticipantController@index_registered');
        Route::get('/create', 'Admin\ParticipantController@create');
        Route::get('/{id}', 'Admin\ParticipantController@show');
        Route::put('/{id}', 'Admin\ParticipantController@update');
        Route::delete('/{id}', 'Admin\ParticipantController@destroy');
        Route::get('/{id}/edit', 'Admin\ParticipantController@edit');
    });

    Route::resource('merchants', 'Admin\MerchantController');

    Route::resource('speakers', 'Admin\SpeakerController');

    Route::group(['prefix' => 'schedule'], function () {
        Route::post('/', 'Admin\ScheduleController@store');
        Route::get('/day1', 'Admin\ScheduleController@index_day1');
        Route::get('/day2', 'Admin\ScheduleController@index_day2');
        Route::get('/create', 'Admin\ScheduleController@create');
        Route::get('/{id}', 'Admin\ScheduleController@show');
        Route::put('/{id}', 'Admin\ScheduleController@update');
        Route::delete('/{id}', 'Admin\ScheduleController@destroy');
        Route::get('/{id}/edit', 'Admin\ScheduleController@edit');
    });

    Route::group(['prefix' => 'attendance'], function () {
        Route::post('/', 'Admin\ScheduleController@store');
        Route::get('/day1', 'Admin\AttendanceController@index_day1');
        Route::get('/day2', 'Admin\AttendanceController@index_day2');
        Route::get('/create', 'Admin\AttendanceController@create');
        Route::get('/{id}', 'Admin\AttendanceController@show');
        Route::put('/{id}', 'Admin\AttendanceController@update');
        Route::delete('/{id}', 'Admin\AttendanceController@destroy');
        Route::get('/{id}/edit', 'Admin\AttendanceController@edit');
    });

    Route::resource('vouchers', 'Admin\VoucherController');

    Route::resource('coupons', 'Admin\CouponController');

    Route::resource('gallery', 'Admin\GalleryController');

    Route::resource('downloads', 'Admin\DownloadController');

});
