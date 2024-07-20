<?php

namespace App\Http\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class PedidoStoreRequest extends FormRequest
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
        return  [
            'cliente_id'                => ['required', 'exists:clientes,id'],
            'produtos'                  => ['required', 'array'],
            'produtos.*.quantidade'     => ['required', 'integer', 'min:1'],
            'produtos.*.valor_unitario' => ['required', 'numeric', 'min:0'],
            'produtos.*.desconto'       => ['nullable', 'numeric', 'min:0'],
            'produtos.*.produto_id'     => ['required', 'exists:produtos,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required' => 'O campo cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente selecionado é inválido.',
            'produtos.required' => 'É necessário adicionar pelo menos um produto.',
            'produtos.*.quantidade.required' => 'A quantidade do produto é obrigatória.',
            'produtos.*.quantidade.integer' => 'A quantidade do produto deve ser um número inteiro.',
            'produtos.*.quantidade.min' => 'A quantidade do produto deve ser pelo menos 1.',
            'produtos.*.valor_unitario.required' => 'O valor unitário do produto é obrigatório.',
            'produtos.*.valor_unitario.numeric' => 'O valor unitário do produto deve ser um número.',
            'produtos.*.valor_unitario.min' => 'O valor unitário do produto deve ser pelo menos 0.',
            'produtos.*.desconto.numeric' => 'O desconto do produto deve ser um número.',
            'produtos.*.desconto.min' => 'O desconto do produto deve ser pelo menos 0.',
            'produtos.*.produto_id.required' => 'O campo produto é obrigatório.',
            'produtos.*.produto_id.exists' => 'O produto selecionado é inválido.',
        ];
    }
}
