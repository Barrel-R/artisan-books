<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroImagemUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("editar imagens");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "livro_id" => "sometimes|exists:livros,id",
            "path" => "sometimes|string|min:1|max:255",
        ];
    }
}
