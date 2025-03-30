<?php

namespace App\Services;

use App\Http\Requests\BookImageStoreRequest;
use App\Http\Requests\BookImageUpdateRequest;
use App\Models\BookImage;

class BookImageService
{
    public function criaImagem(BookImageStoreRequest $request): BookImage
    {
        return BookImage::create($request->validated());
    }

    public function editaImagem(BookImageUpdateRequest $request, string $id)
    {
        return BookImage::find($id)->update($request->validated());
    }
}
