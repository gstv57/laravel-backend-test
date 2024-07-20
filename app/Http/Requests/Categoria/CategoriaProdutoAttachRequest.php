<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaProdutoAttachRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produtos'   => 'required|array',
            'produtos.*' => 'integer|exists:produtos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'produtos.required' => 'A lista de produtos é obrigatória.',
            'produtos.array'    => 'A lista de produtos deve ser um array.',
            'produtos.*.exists' => 'Cada produto deve existir na lista de produtos.',
        ];
    }
}
