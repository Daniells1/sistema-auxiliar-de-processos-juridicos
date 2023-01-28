<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function processo(Request $request){
        $data = [];
        $sql =  "SELECT status, count(*) total, sum(valor_pedido) total_pedido, COALESCE(sum(valor_realizado), 0) total_realizado,
        COALESCE(sum(custo_processo), 0) total_custo, COALESCE(sum(vl_pago), 0) total_comissao,
        (COALESCE(sum(valor_realizado), 0) - COALESCE(sum(vl_pago), 0) - COALESCE(sum(custo_processo), 0)) total_liquido 
        from processos p LEFT JOIN previsao_pagamento_processos pp ON pp.processo_id = p.id ";
        
        $usuario = \Auth::user();
        if($usuario->perfil == "FUNC"){
         $sql .= "WHERE p.advogado_id = " . $usuario->advogado->id;

        }
        $sql .= " group by status ";

        $data["lista"] = \DB::select($sql) ;
        
        return view("admin/relatorio/processo", $data);

    }

    public function autor(Request $request){
        $data = [];
        $sql =  "SELECT nome, count(*) total, group_concat(p.numero) as num_processos from autors a 
        inner join autor_processo ap ON ap.autor_id = a.id
        inner join processos p ON p.id = ap.processo_id ";

            $usuario = \Auth::user();
            if($usuario->perfil == "FUNC"){
            $sql .= " WHERE p.advogado_id = " . $usuario->advogado->id;

            }


        $sql .= " group by a.id ";
        $data["lista"] =\DB::select($sql);

        
        return view("admin/relatorio/autor", $data);

    }

    public function processoPdf(Request $request){

        $data = [];
        $sql = "SELECT status, count(*) total, sum(valor_pedido) total_pedido, COALESCE(sum(valor_realizado), 0) total_realizado,
        COALESCE(sum(custo_processo), 0) total_custo, COALESCE(sum(vl_pago), 0) total_comissao,
        (COALESCE(sum(valor_realizado), 0) - COALESCE(sum(vl_pago), 0) - COALESCE(sum(custo_processo), 0)) total_liquido 
        from processos p LEFT JOIN previsao_pagamento_processos pp ON pp.processo_id = p.id ";

          $usuario = \Auth::user();
          if($usuario->perfil == "FUNC"){
           $sql .= " WHERE p.advogado_id = " . $usuario->advogado->id;
  
          }
          $sql .= " group by status ";

        $data["lista"] = \DB::select($sql) ;
 
        $pdf = \PDF::loadView('admin/relatorio/processo-pdf', $data);
        return $pdf->download('relatorio-processos.pdf');
        
        

    }

    public function advogado(Request $request){
        
        $data = [];
        $sql =  "SELECT nome, count(*) total_processo, sum(valor_pedido) total_pedido, 
        COALESCE(sum(valor_realizado), 0) total_realizado,
        COALESCE(sum(custo_processo), 0) total_custo, COALESCE(sum(vl_pago), 0) total_comissao,
        (COALESCE(sum(valor_realizado), 0) - COALESCE(sum(vl_pago), 0) - COALESCE(sum(custo_processo), 0)) total_liquido  
        from advogados a left join processos p on p.advogado_id = a.id
        LEFT JOIN previsao_pagamento_processos ppp ON ppp.processo_id = p.id 
        where (p.status = 'GANHO' OR p.status = 'ACORDO')
         " ;
        
        $usuario = \Auth::user();
        if($usuario->perfil == "FUNC"){
         $sql .= " AND p.advogado_id = " . $usuario->advogado->id;

        }

         $sql .= " group by a.id ";

        $data["lista"] =\DB::select($sql);

        return view("admin/relatorio/advogado", $data);

    }
    //
}
