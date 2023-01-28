<?php

namespace App\Services;

use App\Models\Processo;
use App\Models\Usuario;
use App\Models\Advogado;

class ProcessoService { 
    public function save(Processo $processo, Usuario $usuario , $idAdvogado , $idReu = [], $idAutor = []){
        try{
           \DB::beginTransaction();
            

           
            $advogado =  Advogado::find($idAdvogado);
            if(!$advogado){
                return ['status' => false, 'message' => 'Advogado não encontrado'];

            }

            $processo->status = "EM ANDAMENTO";

            $processo->advogado()->associate($advogado);
            $processo->usuario()->associate($usuario);
            if(!$processo->save()){
                return ['status' => false, 'message' => $processo->getErrors()];

            }

            $processo->reus()->sync($idReu);
            $processo->autores()->sync($idAutor);
            \DB::commit();
            return ['status' => true, 'message' => ''];


        }catch(\Exception $e){
            \DB::rollback();
            \Log::error("ProcessoService - Save", [ $e->getMessage()]);
            return ['status' => false, 'message' => 'Processo não salvo'];

        }
    }
}
