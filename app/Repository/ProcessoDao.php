<?php

namespace App\Repository;

use App\Models\Processo;

class ProcessoDao{

    /**
     * @var Processo
     */
    private $model;

    public function __construct(Processo $p){
        $this->model = $p;


    }

    public function search(){
        $select = $this->model;
    
        $processo = new Processo();
            
        if($this->model->status != ""){
            $select = $select->where("status", $this->model->status);
        }

        if($this->model->vara != ""){
            $select = $select->where("vara", "like", "%" . $this->model->vara . "%");
        }

        if($this->model->numero != ""){
            $select = $select->where("numero", $this->model->numero);
        }

        
        if($this->model->usuario_id != ""){
            $select = $select->where("usuario_id", $this->model->usuario_id);
        }

        if($this->model->advogado_id != ""){
            $select = $select->where("advogado_id", $this->model->advogado_id);
        }
         
         
        return $select;
     
    }

}