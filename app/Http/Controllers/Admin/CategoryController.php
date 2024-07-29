<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ /**Validar informacion */
            'name' => 'required'
        ]);

        Category::create($request->all()); /**Enviar la informacion del formulario para crear */

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Categoría creada exitosamente'
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada con éxito'); /**Redirigir al index */
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([ /**Validar informacion */
            'name' => 'required'
        ]);

        $category->update($request->all());

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Categoría actualizada exitosamente'
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->subcategories()->count()>0) { /**NO PERIMITIR ELIMINACION: Si la categoria tiene subcategorias */
            session()->flash('swal', [

                'icon'=>'error',
                'title'=>'¡Ups!',
                'text'=>'No se puede eliminar la categoría, porque tiene subcategorías asociadas'
            ]);

            return redirect()->route('admin.categories.edit', $category);
        }

        $category->delete(); /**PERMITIR ELIMINACION */
        session()->flash('swal', [

            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'La categoría fue eliminada correctamente.'
        ]);


        return redirect()->route('admin.categories.index');
    }
}
