<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAutorProcesso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autor_processo', function (Blueprint $table) {
            $table->integer('autor_id')->unsigned();
            $table->integer('processo_id')->unsigned();

            $table->foreign('processo_id')
            ->references('id')
            ->on('processos');

            $table->foreign('autor_id')
            ->references('id')
            ->on('autors');

            $table->primary(['autor_id', 'processo_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autor_processo');
    }
}
