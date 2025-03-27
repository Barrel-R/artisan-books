<?php

namespace App\Services;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Models\Categoria;

class CategoriaService
{
    public function criaCategoria(CategoriaStoreRequest $request)
    {
        return Categoria::create($request->validated());
    }

    public function editaCategoria(CategoriaUpdateRequest $request, string $id)
    {
        return Categoria::find($id)->update($request->validated());
    }
}
