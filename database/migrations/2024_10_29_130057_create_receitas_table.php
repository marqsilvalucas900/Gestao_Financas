<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id(); // ID da receita
            $table->string('descricao'); // Descrição do serviço prestado
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete(); // Chave estrangeira para a tabela de clientes
            $table->decimal('valor', 10, 2); // Valor recebido
            $table->date('data_recebimento'); // Data em que a receita foi recebida
            $table->string('metodo_pagamento'); // Método de pagamento (ex.: transferência, cartão, etc.)
            $table->string('fatura_numero')->nullable(); // Número da fatura (opcional)
            $table->enum('status_pagamento', ['concluido', 'pendente', 'atrasado']); // Status do pagamento
            $table->timestamps(); // Cria os campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('receitas');
    }
}
