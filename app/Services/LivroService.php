<?php

namespace App\Services;

use App\Http\Requests\LivroStoreRequest;
use App\Http\Requests\LivroUpdateRequest;
use App\Models\Livro;

class LivroService
{
    public function criaLivro(LivroStoreRequest $request)
    {
        return Livro::create($request->validated());
    }

    public function editaLivro(LivroUpdateRequest $request, string $id)
    {
        return Livro::find($id)->update($request->validated());
    }
}
