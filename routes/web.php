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
        Route::GET('/adminpanel', 'AdminController@dashboard');
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


