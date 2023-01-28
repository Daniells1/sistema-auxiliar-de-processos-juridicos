<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends BaseModel implements Authenticatable
{
    protected $table = "usuarios";
    protected $fillable = ['email', 'password',  'status', 'perfil'];

   

    protected $messages = [
        'email.required' => 'O campo e-mail é obrigatório',
        'email.unique' => 'O e-mail em questão já está cadastrado no sistema',
        'email.email' => 'Preencha um e-mail válido',
        'password.required' => 'Senha é obrigatória',
       
    ];
    
    public function rules(){
        return [
            'email' => 'required|unique:usuarios,email, ' . $this->id . '|email',
        'password' => 'required'
        ];
    }

    public function beforeSave(){
        
    }

     
    
    public function getAuthIdentifierName(){
        return "id";

    }

   
    public function getAuthIdentifier(){
        return $this->id;
    }

 
    public function getAuthPassword(){
        return $this->password;
    }

   
    public function getRememberToken(){

    }

  
    public function setRememberToken($value){

    }

    public function getRememberTokenName(){

    }

    /**
     * Get the advogado associated with the Advogado
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advogado(): HasOne
    {
        return $this->hasOne(Advogado::class, 'usuario_id');
    }
}
