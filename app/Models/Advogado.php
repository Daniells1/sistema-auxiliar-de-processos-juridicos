<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Advogado extends BaseModel
{
    protected $table = "advogados";
    protected $fillable = ['nome', 'nr_oab', 'usuario_id'];

    protected $rules = [
        'nome' => 'required',
        'nr_oab'=> 'required'
    ];
    protected $messages = [
        'nome.required' => 'O campo nome é obrigatório',
        'nr_oab.required' => 'O campo número da OAB é obrigatório'
    ];
    
    public function beforeSave(){
        
    }

    /**
     * Get the usuario that owns the Advogado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
