<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CategoryStoreRequest, CategoryUpdateRequest};
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia("Category/Index", ["categorias" => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Category/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request, CategoryService $service)
    {
        $service->createCategory($request);
        return to_route("categorias.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia("Category/Show", ["categoria" => Category::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia("Category/Edit", ["categoria" => Category::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id, CategoryService $service)
    {
        $category = Category::findOrFail($id);

        $service->updateCategory($request, $category);
        return to_route('categorias.show', ['categoria' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return to_route('categorias.index');
    }
}
