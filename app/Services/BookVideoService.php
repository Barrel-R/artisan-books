<?php

namespace App\Services;

use App\Http\Requests\BookVideoStoreRequest;
use App\Http\Requests\BookVideoUpdateRequest;
use App\Models\BookVideo;

class BookVideoService
{
    public function criaVideo(BookVideoStoreRequest $request): BookVideo
    {
        return BookVideo::create($request->validated());
    }

    public function editaVideo(BookVideoUpdateRequest $request, string $id)
    {
        return BookVideo::find($id)->update($request->validated());
    }
}
