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
            $table->string('author')->nullable(); // Adiciona a coluna "author"
            $table->string('artist')->nullable(); // Adiciona a coluna "artist"
        });
    }
    
    public function down()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('artist');
        });
    }
    
};
