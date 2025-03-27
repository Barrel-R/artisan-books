<?php

namespace App\Services;

use App\Http\Requests\LivroVideoStoreRequest;
use App\Http\Requests\LivroVideoUpdateRequest;
use App\Models\LivroVideo;

class VideoService
{
    public function criaVideo(LivroVideoStoreRequest $request): LivroVideo
    {
        return LivroVideo::create($request->validated());
    }

    public function editaVideo(LivroVideoUpdateRequest $request, string $id)
    {
        return LivroVideo::find($id)->update($request->validated());
    }
}
