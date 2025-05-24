<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id(); // Crea id (Identificador)
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('restrict')->onUpdate('cascade'); // Clave foránea a clientes
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->timestamps(); // Crea created_at, updated_at (Creado en, Actualizado en)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};