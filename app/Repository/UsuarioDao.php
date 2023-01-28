<?php

namespace App\Repository;

use App\Models\Usuario;

class UsuarioDao {

    /**
     * @var Usuario
     */
  
  private  $model;

    public function __construct(Usuario $u){
      $this->model = $u;

    }
    public function search(){

        $select = new Usuario();
        $select = $this->model;
        if($this->model->email != ""){
            $select = $select->where("email", $this->model->email );
        }
       
        $select = $select->orderBy("email");
                           
       
           return $select;                     
    }
    
    }

