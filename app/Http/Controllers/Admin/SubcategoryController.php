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
        $subcategories=Subcategory::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all(); /**Recuperar listado de categorias, necesario si no se usa el componente(como es el caso) */
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ /**Validar información */
            'category_id' => 'required|exists:categories,id',
            'name' => 'required'
        ], [
            'category_id.required' => 'El campo categoría es obligatorio.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
            'name.required' => 'El campo nombre es obligatorio.',
        ]);
        
        Subcategory::create($request->all());

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Subcategoría creada exitosamente'
        ]);

        return redirect()->route('admin.subcategories.index'); /**Redirigir al index */ 
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
        $categories=Category::all(); /**Recuperar listado de categorias */
        return view('admin.subcategories.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required'
        ]);
    
        $subcategory->update($request->all());
    
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Correcto!',
            'text' => 'Subcategoría actualizada exitosamente'
        ]);
    
        return redirect()->route('admin.subcategories.edit',$subcategory);
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        
        if ($subcategory->products()->count()>0) { 
            session()->flash('swal', [

                'icon'=>'error',
                'title'=>'¡Ups!',
                'text'=>'No se puede eliminar la subcategoría, porque tiene productos asociados'
            ]);

            return redirect()->route('admin.subcategories.edit', $subcategory);
        }

        $subcategory->delete(); 
        session()->flash('swal', [

            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'La subcategoría fue eliminada correctamente.'
        ]);


        return redirect()->route('admin.subcategories.index');
    }
    
}
