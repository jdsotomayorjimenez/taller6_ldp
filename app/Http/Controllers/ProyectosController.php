<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = DB::table('proyectos')->get();

        return view("projects.index", ['proyectos' => $proyectos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("projects.new");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        Proyectos::create($request->all());

        return redirect('projects/')
            ->with('success', 'Proyecto creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = Proyectos::findOrFail($id);

        return view("projects.update", compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $proyecto = Proyectos::findOrFail($id);

        $proyecto->update($request->all());

        return redirect('projects/')
            ->with('success', 'Proyecto actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyectos=Proyectos::findOrFail($id);
        $proyectos->delete();
        return redirect('projects/')
        ->with('success', 'Proyecto eliminado satisfactoriamente.');
    }
}