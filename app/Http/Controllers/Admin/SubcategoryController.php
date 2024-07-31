<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            /**Validar información */
            'category_id' => 'required|exists:categories,id',
            'name' => 'required'
        ], [
            'category_id.required' => 'El campo categoría es obligatorio.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
            'name.required' => 'El campo nombre es obligatorio.',
        ]);

        Subcategory::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Correcto!',
            'text' => 'Subcategoría creada exitosamente'
        ]);

        return redirect()->route('admin.subcategories.index');
        /**Redirigir al index */
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        // Verificar si la subcategoría tiene productos asociados
        if ($subcategory->products->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar la subcategoría porque tiene productos asociados.'
            ]);

            // Redirigir de vuelta al formulario de edición si no se puede eliminar
            return redirect()->route('admin.subcategories.edit', $subcategory);
        }

        // Eliminar la subcategoría
        $subcategory->delete();

        // Mostrar mensaje de éxito
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Correcto!',
            'text' => 'La subcategoría fue eliminada correctamente.'
        ]);

        // Redirigir al índice de subcategorías
        return redirect()->route('admin.subcategories.index');
    }
}
