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

//Adminpanel
Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Admin', 'middleware' => 'lang'], function () {

        //set personal info & Avatar & Password
        Route::get('/profile/{name}' , 'AdminController@profile');
        Route::post('/updateUser' ,'AdminController@updateUser');
        Route::post('/setAvatar' , 'AdminController@updateAdminImage');
        Route::post('/set_password' , 'AdminController@set_password');

        //Dashboard
        Route::GET('/', 'AdminController@dashboard');

        //users
        Route::Resource('/users', 'UserController');

        //drivers
        Route::Post('/drivers/store', 'DriverController@store');
        Route::Post('/drivers/update', 'DriverController@update');
        Route::POST('/drivers/change-password/{id}', 'DriverController@changePassword');
        Route::Resource('/drivers', 'DriverController');

        //cashairs
        Route::Post('/cashairs/store', 'CashairController@store');
        Route::Post('/cashairs/update', 'CashairController@update');
        Route::POST('/cashairs/change-password/{id}', 'CashairController@changePassword');
        Route::Resource('/cashairs', 'CashairController');

        //cashairs
        Route::Post('/categories/store', 'CategoryController@store');
        Route::Post('/categories/update', 'CategoryController@update');
        Route::Resource('/categories', 'CategoryController');

        //meal images
        Route::Post('/meal-images/store', 'MealImageController@store');
        Route::Get('/meal-images/{id}', 'MealImageController@getMealImages');
        Route::Resource('/meal-images', 'MealImageController');

        //meal sizes
        Route::Get('/meal-sizes/{id}', 'MealSizeController@getMealSizes');
        Route::Resource('/meal-sizes', 'MealSizeController');

        //cashairs
        Route::Post('/meals/store', 'MealController@store');
        Route::Post('/meals/update', 'MealController@update');
        Route::Resource('/meals', 'MealController');

        //additions
        Route::Resource('/additions', 'AdditionController');
        //sliders
        Route::Post('/sliders/store', 'SliderController@store');
        Route::Post('/sliders/update', 'SliderController@update');
        Route::Resource('/sliders', 'SliderController');

        //countries
        Route::Resource('/countries', 'CountryController');

        //settings
        Route::Resource('/settings', 'SettingController');

        //regions
        Route::Resource('/regions', 'RegionController');

        //receving types
        Route::Resource('/receving-types', 'RecevingTypeController');

        //promocodes
        Route::Resource('/promocodes', 'PromocodeController');
    });

    Route::get('/lang/{lang}' , function($lang){
        if($lang == 'ar')
            session()->put('lang','ar');
        else
            session()->put('lang','en');
        return back();
    });
    Auth::routes();
});


