<?php

namespace App\Http\Controllers;

use App\Http\Requests\{LivroStoreRequest, LivroUpdateRequest};
use App\Services\LivroService;
use App\Models\Livro;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Livro/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Livro/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroStoreRequest $request, LivroService $service)
    {
        $service->criaLivro($request);
        return to_route('livros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Livro/Show', ['livro' => Livro::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia('Livro/Edit', ['livro' => Livro::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroUpdateRequest $request, string $id, LivroService $service)
    {
        $service->editaLivro($request, $id);
        return to_route('livros.show', ['livro' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Livro::destroy($id);
        return to_route('livros.index');
    }
}
