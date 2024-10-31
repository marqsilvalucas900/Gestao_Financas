<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // ID do cliente
            $table->string('nome'); // Nome do cliente
            $table->string('email')->unique(); // Email do cliente (único)
            $table->string('telefone')->nullable(); // Telefone do cliente (opcional)
            $table->timestamps(); // Cria os campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
