<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipe_id'); // Relacionamento com a equipe
            $table->string('equipe_avaliacao'); // Nome da equipe avaliada
            $table->text('avaliacao_comentario')->nullable(); // Comentário
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipe_id'); // Relacionamento com a equipe
            $table->string('equipe_avaliacao'); // Nome da equipe avaliada
            $table->integer('avaliacao_nota')->unsigned(); // Nota (0-5)
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
        Schema::dropIfExists('comentarios');
    }
};
