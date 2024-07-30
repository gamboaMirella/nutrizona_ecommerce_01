<?php

use App\Livewire\Admin\Products\ProductCreate;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require base_path('routes/admin.php'); //Carga las rutas de admin junto a las propias
Route::get('/admin/products/create', ProductCreate::class)->name('admin.products.create');