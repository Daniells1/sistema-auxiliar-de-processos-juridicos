<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advogado;
use App\Models\Reu;
use App\Models\Autor;
use App\Models\Processo;
use App\Services\ProcessoService;
use App\Repository\ProcessoDao;
use App\Models\Audiencia;

class ProcessoController extends Controller
{
    public function novo(Request $request){
        $data = [];

        $data["listaAdvogados"] = Advogado::orderBy("nome")->get();
        $data["listaReu"] = Reu::orderBy("nome")->get();
        $data["listaAutor"] = Autor::orderBy("nome")->get();

        return view("admin/processo/novo", $data);

    }

    public function processoSave(Request $request ){
        try{
            $processoService = new ProcessoService();
            $processo = new Processo($request->all() );
            $usuario = \Auth::user();
            if($usuario->perfil == "FUNC")

            $idAdvogado = $usuario->advogado->id;
            else

            $idAdvogado = $request->input("advogado");

          

            $idReu = $request->input("reu", []);
            $idAutor = $request->input("autor", []);
            
            $result = $processoService->save($processo, $usuario, $idAdvogado, $idReu, $idAutor);
            if($result["status"] == true){

                $request->session()->flash("success", "Processo salvo com sucesso!");

            }else{
                if(gettype($result["message"]) == "object"){
                    return back()->withErrors($result["message"]);
                }
                $request->session()->flash("error", $result["message"]);

            }
         
           

        }catch(\Exception $e){
            \Log::error("Save Processo", [ $e->getMessage()]);
            
            $request->session()->flash("error", "Processo não salvo !");
        }
        return back();
    }
    public function buscar(Request $request){
        $data = [];

      
            $status = $request->input("status");
            $vara = $request->input("vara");
            $numero = $request->input("numero");

            $user = \Auth::user();


            $processo = new Processo();
            $processo->status = $status;
            $processo->vara = $vara;
            $processo->numero = $numero;

            if($user->perfil == "FUNC"){
                $processo->advogado_id = $user->advogado->id;

            }

            $processoDao = new ProcessoDao($processo);


            $lista = $processoDao->search()
                                 ->orderBy("dt_inicio", "desc")
                                 ->paginate(20);
                               //  ->limit(100)
                                // ->get();

            $data["lista"] = $lista;

        

        return view("admin/processo/buscar", $data);
    }

    public function audiencia($id, Request $request){
        $data = [];

        $processo = Processo::find($id);

        if(!$processo){
            $request->session()->flash("error", "Processo não encontrado");

            return back();
        }

        $listaAudiencia = Audiencia::where("processo_id", $id)
                                     ->orderBy("dt_audiencia", "desc")
                                     ->orderBy("hr_audiencia", "asc")
                                     ->get();
        $data["processo"] = $processo;
        $data["listaAudiencia"] = $listaAudiencia;
       
        return view("admin/processo/audiencia", $data);

    }

    public function audienciaSave($id, Request $request){
        try{
            \DB::beginTransaction();
            $status = $request->input("status");
            $peticao_final = $request->input("peticao_final");
            $valor_realizado = $request->input("valor_realizado");
            $custo_processo = $request->input("custo_processo");

            $processo = Processo::find($id);
            $processo->status = $status;
            $processo->peticao_final = $peticao_final;
            $processo->valor_realizado = $valor_realizado;
            $processo->custo_processo = $custo_processo;

            $processo->save(['ignoreValidate' => true]);

            $audiencia = new Audiencia($request->all());

            $audiencia->processo()->associate($processo);
            if(!$audiencia->save()){
                \DB::rollback();
                return back()->withErrors( $audiencia->getErrors());
            }
            \DB::commit();


            $audiencia->save();

            $request->session()->flash("success", "Audiencia salva com sucesso!");



        }catch(\Exception $e){
            \DB::rollback();
            \Log::error("Save audiencia", [ $e->getMessage()]);

            $request->session()->flash("error", "Audiencia não pode ser salva!");


        }

        return back();
    }

    public function detalhes(Request $request){
        $idprocesso = $request->input("idprocesso");

       $processo = Processo::find($idprocesso);

       $audiencias = Audiencia::where("processo_id", $idprocesso)
                               ->orderBy("dt_audiencia", "desc")
                               ->orderBy("hr_audiencia", "asc")
                               ->get(); 

       $data = [];

       $data["processo"] = $processo;
       $data["listaAudiencia"] = $audiencias
       ;

       return view("admin.processo.detalhes" , $data);
    }

}
