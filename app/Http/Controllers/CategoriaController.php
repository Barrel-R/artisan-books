<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Models\Categoria;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia("Categoria/Index", ["categorias" => Categoria::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Categoria/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaStoreRequest $request, CategoriaService $service)
    {
        $service->criaCategoria($request);
        return to_route("categorias.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia("Categoria/Show", ["categoria" => Categoria::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia("Categoria/Edit", ["categoria" => Categoria::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaUpdateRequest $request, string $id, CategoriaService $service)
    {
        $service->editaCategoria($request, $id);
        return to_route('categorias.show', ['categoria' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoria::destroy($id);
        return to_route('categorias.index');
    }
}
