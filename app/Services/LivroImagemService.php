<?php

namespace App\Services;

use App\Http\Requests\LivroImagemStoreRequest;
use App\Http\Requests\LivroImagemUpdateRequest;
use App\Models\LivroImagem;

class ImagemService
{
    public function criaImagem(LivroImagemStoreRequest $request): LivroImagem
    {
        return LivroImagem::create($request->validated());
    }

    public function editaImagem(LivroImagemUpdateRequest $request, string $id)
    {
        return LivroImagem::find($id)->update($request->validated());
    }
}
