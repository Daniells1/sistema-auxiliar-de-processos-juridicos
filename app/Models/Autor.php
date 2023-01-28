<?php

namespace App\Models;

use App\Rules\CpfCnpjRule;

class Autor extends BaseModel
{
    protected $table = "autors";
    protected $fillable = ["nome", "cpf_cnpj", "email", "telefone"];
    
 

    protected $messages = [
        'nome.required' => 'Campo nome é obrigatório',
        'nome.min' => 'Campo nome mínimo de 3 caracter',
        'cpf_cnpj.required' => 'Campo CPF/CNPJ é obrigatório',
        'email.required' => 'E-mail é obrigatório',
        'email.email' => 'Preencha um E-mail válido',

    ];

    public function rules(){
        return [
            'nome' => 'required|min:3',
            'cpf_cnpj' => ['required', new CpfCnpjRule()],
            'email' => 'required|email'
        ];

    }

    public function beforeSave(){
        
    }
}
