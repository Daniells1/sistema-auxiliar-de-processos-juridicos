<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero', 100);
            $table->date('dt_inicio');
            $table->text('peticao_inicial')->nullable();
            $table->string('vara', 100);
            $table->decimal('valor_pedido', 10,2)->nullable();
            $table->string('status', 20);
            $table->text('peticao_final')->nullable();

            $table->integer('usuario_id')->unsigned();
            $table->integer('advogado_id')->unsigned();

            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios');

            $table->foreign('advogado_id')
            ->references('id')
            ->on('advogados');





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processos');
    }
}
