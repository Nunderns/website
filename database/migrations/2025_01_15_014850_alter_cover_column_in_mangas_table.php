<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCoverColumnInMangasTable extends Migration
{
    /**
     * Execute the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->string('cover')->nullable()->change(); // Altera para permitir valores nulos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->string('cover')->nullable(false)->change(); // Reverte a mudança, tornando obrigatória
        });
    }
}
