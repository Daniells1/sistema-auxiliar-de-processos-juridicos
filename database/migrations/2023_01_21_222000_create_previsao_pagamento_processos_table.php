<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrevisaoPagamentoProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsao_pagamento_processos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->decimal("vl_pago", 10 , 2);

            $table->date("dt_pagamento");

            $table->integer("advogado_id")->unsigned();
            $table->integer("processo_id")->unsigned();


            $table->foreign("advogado_id")
                  ->references("id")
                  ->on("advogados");
            
                  $table->foreign("processo_id")
                  ->references("id")
                  ->on("processos");


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
        Schema::dropIfExists('previsao_pagamento_processos');
    }
}
