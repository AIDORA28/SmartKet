<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // Crea id (Identificador)
            $table->string('nombre', 80);
            $table->date('fecha_registro')->nullable();
            $table->boolean('activo')->default(true)->comment('1 = Activo, 0 = Inactivo');
            $table->string('tipo', 15)->nullable()->comment('Ej. Producto, Servicio');
            $table->timestamps(); // Crea created_at, updated_at (Creado en, Actualizado en)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};