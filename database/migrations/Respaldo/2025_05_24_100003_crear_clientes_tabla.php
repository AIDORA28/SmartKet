<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearClientesTabla extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('idClientes');
            $table->string('asaas_id', 255)->nullable();
            $table->string('nomeCliente', 255);
            $table->string('sexo', 20)->nullable();
            $table->boolean('pessoa_fisica')->default(true);
            $table->string('documento', 20);
            $table->string('telefone', 20);
            $table->string('celular', 20)->nullable();
            $table->date('dataCadastro')->nullable();
            $table->string('rua', 70)->nullable();
            $table->string('numero', 15)->nullable();
            $table->string('bairro', 45)->nullable();
            $table->string('cidade', 45)->nullable();
            $table->string('estado', 20)->nullable();
            $table->string('cep', 20)->nullable();
            $table->string('contato', 45)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->boolean('fornecedor')->default(false);
            $table->index('documento', 'idx_clientes_documento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
