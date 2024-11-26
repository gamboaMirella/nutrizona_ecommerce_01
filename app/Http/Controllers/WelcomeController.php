<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $covers = Cover::where('is_active', true)
            ->whereDate('start_at', '<=', now())
            ->where(function($query) {
                $query->whereDate('end_at', '>=', now())
                    ->orWhereNull('end_at');
            })
            ->orderBy('order')->get();

        // Cambiar el orden de los productos por ID en orden ascendente
        $lastProducts = Product::orderBy('id', 'asc')
            ->take(12)
            ->get();
        
        return view('welcome', compact('covers', 'lastProducts'));
    }
}