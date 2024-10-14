<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cnab_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->date('data');
            $table->decimal('valor', 10, 2);
            $table->string('cpf', 11);
            $table->string('cartao', 12);
            $table->time('hora');
            $table->string('dono_loja');
            $table->string('nome_loja');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cnab_transactions');
    }
};
