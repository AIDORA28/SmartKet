<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Crea id (Identificador)
            $table->string('nombre', 255);
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('restrict')->onUpdate('cascade'); // Clave foránea a categorias
            $table->timestamps(); // Crea created_at, updated_at (Creado en, Actualizado en)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};