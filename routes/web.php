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
Route::prefix("admin")->group(function(){
    Route::get("/","AdminsController@index")->name("admin.dashboard");
    Route::get("login","Auth\AdminLoginController@loginForm")->name("admin.loginForm");
    Route::post("login","Auth\AdminLoginController@login")->name("admin.login.submit");
    Route::post("logout","Auth\AdminLoginController@logout")->name("admin.logout");
    Route::get("password/reset","Auth\AdminForgotPasswordController@showLinkRequestForm")->name("admin.password.request");
    Route::post("password/email","Auth\AdminForgotPasswordController@sendResetLinkEmail")->name("admin.password.email");
    Route::get("password/reset/{token}","Auth\AdminResetPasswordController@showResetForm")->name("admin.password.reset");
    Route::post("password/reset","Auth\AdminResetPasswordController@reset");

});
Route::prefix("product")->middleware("auth:admin")->group(function(){
Route::get("step1Form","ProductsController@productInfo")->name("product.info.form");
Route::post("step1From","ProductsController@productInfo")->name("product.info.form.submit");
Route::get("step2Form","ProductsController@imageUpload")->name("product.image-upload");
Route::post("step2Form","ProductsController@imageUpload")->name("product.image-upload.submit");
Route::get("step3Form","ProductsController@saveProduct")->name("product.details");
Route::post("step3Form","ProductsController@saveProduct")->name("product.details.submit");
Route::get("/","ProductsController@index")->name("product.all");

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
