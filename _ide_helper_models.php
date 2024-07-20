<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $data_de_nascimento
 * @property string $cpf
 * @property string $sexo
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pedido> $pedidos
 * @property-read int|null $pedidos_count
 * @method static \Database\Factories\ClienteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDataDeNascimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 */
	class Cliente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $status_do_pedido
 * @property string|null $sub_total
 * @property string|null $total_pedido
 * @property string|null $desconto
 * @property \Illuminate\Support\Carbon $data_pedido_efetuado
 * @property \Illuminate\Support\Carbon|null $data_pedido_pagamento
 * @property \Illuminate\Support\Carbon|null $data_pedido_entrega
 * @property \Illuminate\Support\Carbon|null $data_pedido_vencimento
 * @property string|null $forma_de_pagamento
 * @property-read \App\Models\Cliente $cliente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PedidoProduto> $produtos
 * @property-read int|null $produtos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDataPedidoEfetuado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDataPedidoEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDataPedidoPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDataPedidoVencimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereDesconto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereFormaDePagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereStatusDoPedido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereTotalPedido($value)
 */
	class Pedido extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $produto_id
 * @property int $quantidade
 * @property string $valor_unitario
 * @property string|null $desconto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pedido $pedido
 * @property-read \App\Models\Produto $produto
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto query()
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereDesconto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto wherePedidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereProdutoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereQuantidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PedidoProduto whereValorUnitario($value)
 */
	class PedidoProduto extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $preco
 * @property int $quantidade
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PedidoProduto> $pedidos
 * @property-read int|null $pedidos_count
 * @method static \Database\Factories\ProdutoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto wherePreco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereQuantidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereUpdatedAt($value)
 */
	class Produto extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

