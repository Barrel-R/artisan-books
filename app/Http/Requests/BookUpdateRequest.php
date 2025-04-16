<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|min:3|max:255',
            'long_description' => 'nullable|string|min:3',
            'price' => 'sometimes|numeric|min:1|decimal:2',
            'age_range' => 'sometimes|string|max:50',
            'page_count' => 'sometimes|integer|min:1',
            'materials' => 'nullable|string',
            'dimensions' => 'sometimes|string|max:100',
            'manufacturing_time' => 'sometimes|string|max:100',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos' => 'nullable|array',
            'videos.*' => 'mimetypes:video/mp4,video/quicktime|max:10240'
        ];
    }
}
