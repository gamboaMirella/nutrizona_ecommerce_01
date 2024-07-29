<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

//Prob: Poner un middlewire para permitir acceso solo a usuarios autenticados
Route::get('/admin/dashboard', function () { //Poner siempre: /admin/----
    return view('admin.dashboard'); 
})->name('admin.dashboard'); //Poner siempre: admin.----

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);




