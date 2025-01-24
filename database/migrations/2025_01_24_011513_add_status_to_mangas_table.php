<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->string('status')->default('ongoing'); // Adiciona a coluna "status" com valor padrão "ongoing"
        });
    }
    
    public function down()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->dropColumn('status'); // Remove a coluna em caso de rollback
        });
    }
    
};
