<?php



namespace App\Observers;

use App\Models\Processo;
use App\Models\Advogado;
use App\Models\PrevisaoPagamentoProcesso;


class ProcessoObserver
{
    public function updated(Processo $processo){
        try{

            if(in_array( $processo->status, ["GANHO", "PERDIDO", "ACORDO"] ) ){

                $hoje = \Carbon\Carbon::now();
                $hoje->addDays(env("DIAS_PAGAMENTO", 30));

                $previsao =  PrevisaoPagamentoProcesso::where("processo_id", $processo->id)->first();
                if(!$previsao){
                    $previsao = new PrevisaoPagamentoProcesso();
                }

                $advogado = Advogado::find($processo->advogado_id);
                $comissao = $processo->comissao;
                if(is_null($comissao) || !is_numeric($comissao)){
                    $comissao = env("COMISSAO", 10);
                }

                $valorPago = $processo->valor_realizado * ( $comissao / 100);


                $previsao->vl_pago = $valorPago;
                $previsao->dt_pagamento = $hoje->format("d/m/Y");
                $previsao->processo()->associate($processo);
                $previsao->advogado()->associate($advogado);

                $previsao->save();

            }

        }catch(\Exception $e){
            \Log::error("Erro no observer Processo", [ $e->getMessage()]);
        }

    }
}
