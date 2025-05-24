<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearDetallesVentasTabla extends Migration
{
    public function up()
    {
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('productos')->onDelete('restrict');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->primary(['id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_ventas');
    }
}
