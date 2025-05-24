<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearRestablecimientosContraseñasTabla extends Migration
{
    public function up()
    {
        Schema::create('restablecimientos_contraseñas', function (Blueprint $table) {
            $table->id();
            $table->string('email', 200);
            $table->string('token', 255);
            $table->dateTime('data_expiracao');
            $table->tinyInteger('token_utilizado');
            $table->index('email', 'idx_restablecimientos_email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('restablecimientos_contraseñas');
    }
}

