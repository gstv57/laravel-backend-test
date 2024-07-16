<?php

use App\Models\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class);
            $table->char('rua', 50);
            $table->char('numero', 5);
            $table->text('complemento');
            $table->char('bairro', 30);
            $table->char('cidade', 20);
            $table->char('estado', 2);
            $table->char('cep', 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
