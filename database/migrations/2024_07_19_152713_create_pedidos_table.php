<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->enum('status_do_pedido', ['pendente', 'processando', 'enviado', 'entregue', 'cancelado', 'arquivado']);
            $table->decimal('sub_total', 8, 2)->nullable();
            $table->decimal('total_pedido', 8, 2)->nullable();
            $table->decimal('desconto', 8, 2)->nullable();
            $table->enum('forma_de_pagamento', ['pix', 'cartao', 'boleto', 'transferencia'])->nullable();
            $table->dateTime('data_pedido_efetuado');
            $table->dateTime('data_pedido_pagamento')->nullable();
            $table->dateTime('data_pedido_entrega')->nullable();
            $table->dateTime('data_pedido_vencimento')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
