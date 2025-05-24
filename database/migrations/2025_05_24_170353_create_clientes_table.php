<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Crea id (Identificador)
            $table->string('asaas_id', 255)->nullable();
            $table->string('nombre', 255);
            $table->string('sexo', 20)->nullable();
            $table->boolean('es_persona_fisica')->default(true)->comment('1 = Persona física, 0 = Empresa');
            $table->string('documento', 20);
            $table->string('telefono', 20);
            $table->string('celular', 20)->nullable();
            $table->string('email', 100)->unique();
            $table->string('calle', 70)->nullable();
            $table->string('numero', 15)->nullable();
            $table->string('barrio', 45)->nullable();
            $table->string('ciudad', 45)->nullable();
            $table->string('estado', 20)->nullable();
            $table->string('cep', 20)->nullable();
            $table->string('contacto', 45)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->boolean('es_proveedor')->default(false)->comment('1 = Proveedor, 0 = Cliente');
            $table->timestamps(); // Crea created_at, updated_at (Creado en, Actualizado en)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};