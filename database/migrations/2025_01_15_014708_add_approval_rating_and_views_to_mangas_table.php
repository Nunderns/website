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
            if (!Schema::hasColumn('mangas', 'approval_rating')) {
                $table->float('approval_rating')->default(0);
            }
            // Remova ou comente a linha abaixo, pois 'views' já existe:
            // $table->unsignedBigInteger('views')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('mangas', function (Blueprint $table) {
            if (Schema::hasColumn('mangas', 'approval_rating')) {
                $table->dropColumn('approval_rating');
            }
            // Remova ou comente a linha abaixo, pois 'views' já existe:
            // $table->dropColumn('views');
        });
    }
    
    
};
