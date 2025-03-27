<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\LivroImagem;
use App\Services\LivroImagemService;
use App\Http\Requests\{LivroImagemStoreRequest, LivroImagemUpdateRequest};

class LivroImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: adicionar query string de numeros de itens paginados

        return inertia(
            'Imagens/Index',
            ['imagens' => LivroImagem::paginate(9)->load('livro')]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: adicionar livros ao cache
        return inertia('Imagens/Create', ['livros' => Livro::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroImagemStoreRequest $request, LivroImagemService $service)
    {
        $service->criaImagem($request);
        return to_route('imagens.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Imagens/Show', ['imagem' => LivroImagem::find($id)->load('livro')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia('Imagems/Edit', ['imagem' => LivroImagem::find($id)->load('livro')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroImagemUpdateRequest $request, string $id, LivroImagemService $service)
    {
        $service->editaImagem($request, $id);
        return to_route('imagens.show', ['imagem' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LivroImagem::destroy($id);
        return to_route('imagens.index');
    }
}
