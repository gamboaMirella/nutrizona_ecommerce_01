<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required'
        ], [
            'subcategory_id.required' => 'El campo subcategoría es obligatorio.',
            'subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
            'name.required' => 'El campo nombre es obligatorio.',
        ]);

        Product::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Correcto!',
            'text' => 'Producto creado exitosamente'
        ]);

        return redirect()->route('admin.products.index'); */
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        /* $subcategories = Subcategory::all();
        return view('admin.products.edit', compact('products', 'subcategories')); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        /* $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required'
        ]);

        $product->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Correcto!',
            'text' => 'Producto actualizado exitosamente'
        ]);

        return redirect()->route('admin.products.edit', $product); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
