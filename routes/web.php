<?php

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'FrontendController@index');
    Route::post('/payment-confirmation', 'FrontendController@store');
    Route::get('/payment-confirmation', 'FrontendController@confirmation');
});


Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');

Route::get('/register-status', function() {
    return view('frontend.register');
});

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
        Route::get('/all', 'Admin\ParticipantController@index_all');
        Route::get('/unregistered', 'Admin\ParticipantController@index_unregistered');
        Route::get('/confirmation', 'Admin\ParticipantController@index_confirmation');
        Route::get('/registered', 'Admin\ParticipantController@index_registered');
        Route::get('/create', 'Admin\ParticipantController@create');
        Route::get('/confirmation/{id}', 'Admin\ParticipantController@show_confirmation');
        Route::put('/confirmation/{id}', 'Admin\ParticipantController@confirm');
        Route::get('/{id}', 'Admin\ParticipantController@show');
        Route::put('/{id}', 'Admin\ParticipantController@update');
        Route::delete('/{id}', 'Admin\ParticipantController@destroy');
        Route::get('/{id}/edit', 'Admin\ParticipantController@edit');
    });

    Route::resource('merchants', 'Admin\MerchantController');

    Route::resource('speakers', 'Admin\SpeakerController');

    Route::group(['prefix' => 'schedule'], function () {
        Route::post('/day1', 'Admin\ScheduleController@store_day1');
        Route::post('/day2', 'Admin\ScheduleController@store_day2');
        Route::get('/day1', 'Admin\ScheduleController@index_day1');
        Route::get('/day2', 'Admin\ScheduleController@index_day2');
        Route::post('/category', 'Admin\ScheduleController@store_category');
        Route::get('/category', 'Admin\ScheduleController@index_category');
        Route::get('/day1/create', 'Admin\ScheduleController@create');
        Route::get('/day2/create', 'Admin\ScheduleController@create');
        Route::get('/category/create', 'Admin\ScheduleController@create_category');
        Route::delete('/category/{id}', 'Admin\ScheduleController@destroy_category');
        Route::put('/{id}', 'Admin\ScheduleController@update');
        Route::delete('/{id}', 'Admin\ScheduleController@destroy');
        Route::get('/{id}/edit', 'Admin\ScheduleController@edit');
    });

    Route::group(['prefix' => 'attendance'], function () {
        Route::post('/', 'Admin\AttendanceController@store');
        Route::get('/day1', 'Admin\AttendanceController@index_day1');
        Route::get('/day2', 'Admin\AttendanceController@index_day2');
        Route::get('/create', 'Admin\AttendanceController@create');
        Route::get('/{id}', 'Admin\AttendanceController@show');
        Route::put('/{id}', 'Admin\AttendanceController@update');
        Route::delete('/{id}', 'Admin\AttendanceController@destroy');
        Route::get('/{id}/edit', 'Admin\AttendanceController@edit');
    });

    Route::resource('vouchers', 'Admin\VoucherController');

    Route::resource('transactions/all', 'Admin\TransactionController');

    Route::resource('transactions/cashback', 'Admin\CashbackController');

    Route::resource('coupons', 'Admin\CouponController');

    Route::resource('gallery', 'Admin\GalleryController');

    Route::resource('downloads', 'Admin\DownloadController');

    Route::group(['prefix' => 'setting'], function () {
        Route::post('/', 'Admin\SettingController@store');
        Route::get('/day1', 'Admin\SettingController@index');
        Route::get('/create', 'Admin\SettingController@create');
        Route::get('/{id}', 'Admin\SettingController@show');
        Route::put('/{id}', 'Admin\SettingController@update');
        Route::delete('/{id}', 'Admin\SettingController@destroy');
        Route::get('/{id}/edit', 'Admin\SettingController@edit');
    });

});
