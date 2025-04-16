<?php

namespace App\Services;

use App\Http\Requests\{CategoryStoreRequest, CategoryUpdateRequest};
use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::latest()->get();
    }

    public function createCategory(CategoryStoreRequest $request): Category
    {
        return Category::create($request->validated());
    }

    public function updateCategory(CategoryUpdateRequest $request, Category $category): Category
    {
        $category->update($request->validated());
        return $category->fresh();
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
