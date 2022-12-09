<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('codigo');
            $table->string('transportadora');
            $table->string('status');
            $table->string('ultima_atualizacao');
            $table->boolean('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encomendas');
    }
};
