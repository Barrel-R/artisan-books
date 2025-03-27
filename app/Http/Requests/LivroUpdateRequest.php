<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("editar livros");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "titulo" => "sometimes|string|min:3|max:255",
            "descricao" => "sometimes|string|min:3|max:255",
            "descricaoLonga" => "sometimes|string|min:3|max:3000",
            "genero" => "sometimes|string|min:3|max:255",
        ];
    }
}
