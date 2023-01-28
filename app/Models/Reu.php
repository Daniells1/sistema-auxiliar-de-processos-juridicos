<?php

namespace App\Models;

use App\Rules\CpfCnpjRule;



class Reu extends BaseModel
{
    protected $table = "reus";
    protected $fillable = ['nome', 'cpf_cnpj'];

    protected $messages = [
        'nome.required' => 'O campo nome é obrigatório',
        'nome.min' => 'Mínimo de 3 caracter para o nome',
        'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório'
    ];

    public function rules(){
        return [
              'nome' => 'required|min:3',
              'cpf_cnpj' => ['required', new CpfCnpjRule()]
        ];
    }
    
    public function beforeSave(){
        
    }
}
