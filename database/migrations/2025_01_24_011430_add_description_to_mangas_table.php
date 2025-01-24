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
            $table->text('description')->nullable(); // Adiciona a coluna "description"
        });
    }
    
    public function down()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->dropColumn('description'); // Remove a coluna caso seja revertido
        });
    }
    
};
