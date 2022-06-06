<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\VendorController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>'auth:admin'],function(){
     Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
     Route::resource('language',LanguagesController::class);

     Route::resource('maincategories',MainCategoryController::class);
     Route::get('maincategories/changestatus/{id}',[MainCategoryController::class,'ChangeStatus'])->name('maincategories.Changestatus');

     Route::resource('vendors',VendorController::class);
     Route::get('vendors/changestatus/{id}',[VendorController::class,'ChangeStatus'])->name('vendors.status');


 });

Route::group(['namespace'=>'admin','middleware'=>'guest:admin'],function(){
   Route::get('login',[LoginController::class,'getLogin'])->name('get.admin.login');
   Route::post('login',[LoginController::class,'login'])->name('admin.login');


});
