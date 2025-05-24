<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearCiSessionsTabla extends Migration
{
    public function up()
    {
        Schema::create('ci_sessions', function (Blueprint $table) {
            $table->string('id', 128)->primary();
            $table->string('ip_address', 45);
            $table->unsignedInteger('timestamp')->default(0);
            $table->binary('data');
            $table->index('timestamp', 'ci_sessions_timestamp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ci_sessions');
    }
}

