<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\WelcomeController;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Database\Seeders\CategorySeeder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

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


Route::get('category/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('shipping', [ShippingController::class, 'index'])->name('shipping.index');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout/paid', [CheckoutController::class, 'paid'])->name('checkout.paid');

Route::get('gracias', function() {
    return view('gracias');
})->name('gracias');


Route::get('prueba', function() {
    $order = Order::first();

    $pdf = Pdf::loadView('orders.ticket', compact('order'))
        ->setPaper('a5');

    // return $pdf->stream();
    $pdf->save(storage_path('app/public/tickets/ticket-' . $order->id . '.pdf'));

    $order->pdf_path = 'tickest/ticket-' . $order->id . '.pdf';
    $order->save();

    // return "Ticket generado correctamente";
    // return view('orders.ticket', compact('order'));
});

