<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\LivroVideo;
use App\Http\Requests\{LivroVideoStoreRequest, LivroVideoUpdateRequest};
use App\Services\LivroVideoService;
use Illuminate\Support\Facades\Gate;

class LivroVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('ver videos');

        // TODO: adicionar query string de numeros de itens paginados

        return inertia(
            'Video/Index',
            ['videos' => LivroVideo::paginate(9)->load('livro')]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('criar videos');

        // TODO: adicionar livros ao cache
        return inertia('Video/Create', ['livros' => Livro::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroVideoStoreRequest $request, LivroVideoService $service)
    {
        $service->criaVideo($request);
        return to_route('videos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('ver um video');

        return inertia('Video/Show', ['video' => LivroVideo::find($id)->load('livro')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('editar videos');

        return inertia('Video/Edit', ['imagem' => LivroVideo::find($id)->load('livro')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroVideoUpdateRequest $request, string $id, LivroVideoService $service)
    {
        $service->editaVideo($request, $id);
        return to_route('videos.show', ['video' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LivroVideo::destroy($id);
        return to_route('videos.index');
    }
}
