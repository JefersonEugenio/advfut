<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->id();
            $table->date('data');
            $table->time('hora');
            $table->time('duracao');
            $table->string('tipo');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('pagamento');
            $table->text('observacao')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }

};