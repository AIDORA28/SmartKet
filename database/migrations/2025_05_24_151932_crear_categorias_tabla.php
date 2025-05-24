<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearCategoriasTabla extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('idCategorias');
            $table->string('categoria', 80);
            $table->date('cadastro')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('tipo', 15)->nullable();
            $table->index('categoria', 'idx_categorias_categoria');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
