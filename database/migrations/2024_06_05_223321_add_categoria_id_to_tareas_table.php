<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaIdToTareasTable extends Migration {
    public function up()
{
    Schema::table('tareas', function (Blueprint $table) {
        $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tareas', function (Blueprint $table) {
            //
        });
    }

};
