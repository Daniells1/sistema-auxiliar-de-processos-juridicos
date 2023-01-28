<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReuProcesso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reu_processo', function (Blueprint $table) {
            $table->integer('reu_id')->unsigned();
            $table->integer('processo_id')->unsigned();

            $table->foreign('processo_id')
            ->references('id')
            ->on('processos');

            $table->foreign('reu_id')
            ->references('id')
            ->on('reus');

            $table->primary(['reu_id', 'processo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reu_processo');
    }
}
