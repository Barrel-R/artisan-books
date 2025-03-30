<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can("criar livros");
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:3|max:255',
            'long_description' => 'nullable|string|min:3',
            'price' => 'required|numeric|min:1|decimal:2',
            'age_range' => 'required|string|max:50',
            'page_count' => 'required|integer|min:1',
            'materials' => 'nullable|string',
            'dimensions' => 'required|string|max:100',
            'manufacturing_time' => 'required|string|max:100',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos' => 'nullable|array',
            'videos.*' => 'mimetypes:video/mp4,video/quicktime|max:10240'
        ];
    }
}
