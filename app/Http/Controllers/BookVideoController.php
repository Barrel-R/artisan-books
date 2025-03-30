<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookVideo;
use App\Http\Requests\{BookVideoStoreRequest, BookVideoUpdateRequest};
use App\Services\BookVideoService;
use Illuminate\Support\Facades\Gate;

class BookVideoController extends Controller
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
            ['videos' => BookVideo::paginate(9)->load('book')]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('criar videos');

        // TODO: adicionar livros ao cache
        return inertia('Video/Create', ['livros' => Book::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookVideoStoreRequest $request, BookVideoService $service)
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

        return inertia('Video/Show', ['video' => BookVideo::find($id)->load('book')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('editar videos');

        return inertia('Video/Edit', ['imagem' => BookVideo::find($id)->load('book')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookVideoUpdateRequest $request, string $id, BookVideoService $service)
    {
        $service->editaVideo($request, $id);
        return to_route('videos.show', ['video' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BookVideo::destroy($id);
        return to_route('videos.index');
    }
}
