<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('equipes', function (Blueprint $table) {
            Schema::table('equipes', function (Blueprint $table) {
                $table->unsignedBigInteger('agenda_id')->nullable()->after('id');
                $table->foreign('agenda_id')->references('id')->on('agendas')->onDelete('cascade');
            });
        });
    }

    public function down(): void
    {
        Schema::table('equipes', function (Blueprint $table) {
            Schema::table('equipes', function (Blueprint $table) {
                $table->dropForeign(['agenda_id']);
                $table->dropColumn('agenda_id');
            });
        });
    }

};