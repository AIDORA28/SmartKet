<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->id(); // Crea id (Identificador)
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade')->onUpdate('cascade'); // Clave foránea a ventas
            $table->foreignId('producto_id')->constrained('productos')->onDelete('restrict')->onUpdate('cascade'); // Clave foránea a productos
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps(); // Crea created_at, updated_at (Creado en, Actualizado en)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_ventas');
    }
};