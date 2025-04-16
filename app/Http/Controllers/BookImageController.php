<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookImage;
use App\Services\BookImageService;
use App\Http\Requests\{BookImageStoreRequest, BookImageUpdateRequest};

class BookImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: adicionar query string de numeros de itens paginados

        return inertia(
            'Images/Index',
            ['images' => BookImage::paginate(9)->load('book')]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: adicionar livros ao cache
        return inertia('Images/Create', ['livros' => Book::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookImageStoreRequest $request, BookImageService $service)
    {
        $service->criaImagem($request);
        return to_route('imagens.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Images/Show', ['imagem' => BookImage::find($id)->load('book')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia('Imagems/Edit', ['imagem' => BookImage::find($id)->load('book')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookImageUpdateRequest $request, string $id, BookImageService $service)
    {
        $service->editaImagem($request, $id);
        return to_route('imagens.show', ['imagem' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BookImage::destroy($id);
        return to_route('imagens.index');
    }
}
