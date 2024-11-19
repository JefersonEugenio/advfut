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
        Schema::table('agendas', function (Blueprint $table) {
            // Colunas de relacionamento com a tabela `equipes`
            $table->foreignId('equipe_me')->constrained('equipes')->onDelete('cascade');
            $table->foreignId('equipe_adversario')->nullable()->constrained('equipes')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            // Remover as chaves estrangeiras
            $table->dropForeign(['equipe_me']);
            $table->dropForeign(['equipe_adversario']);
            $table->dropForeign(['user_id']);
    
            // Opcional: remover as colunas, se necessário
            $table->dropColumn(['equipe_me', 'equipe_adversario']);
        });
    }
};
