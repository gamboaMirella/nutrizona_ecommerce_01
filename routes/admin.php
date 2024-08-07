<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;

use Illuminate\Support\Facades\Route;

//Prob: Poner un middleware para permitir acceso solo a usuarios autenticados
Route::get('/admin/dashboard', function () { //Poner siempre: /admin/----
    return view('admin.dashboard'); 
})->name('admin.dashboard'); //Poner siempre: admin.----

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);


Route::resource('covers', CoverController::class);

Route::get('orders', [OrderController::class, 'index'])
    ->name('orders.index');


