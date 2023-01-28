<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;
use  \Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Processo extends BaseModel
{
    protected $table = "processos";
    protected $fillable = ['numero', 'dt_inicio', 'peticao_inicial', 'vara',
     'valor_pedido', 'status', 'peticao_final', 'usuario_id', 'advogado_id',
    'comissao', 'valor_realizado', 'custo_processo'];
    

    protected  $messages = [
            'numero.required' => 'O campo número do processo é obrigatório',
            'numero.unique' => 'O campo número do processo já consta no banco de dados',
            'dt_inicio.required' => 'O campo data de ínicio é obrigatório', 
            'vara.required' => 'O campo vara é obrigatório',
            'valor_pedido.required' => 'O campo valor pedido é obrigatório',
            'valor_pedido.numeric' => 'O campo valor pedido deve ser um  valor numérico',
            'status.required' => 'O campo status é obrigatório', 
            'usuario_id.required' => 'O campo usuario é obrigatório', 
            'advogado_id.required' => 'O campo advogado é obrigatório',
            'comissao.numeric' => 'O campo comissão deve ser um valor numérico',
            'valor_realizado.numeric' => 'O campo valor realizado deve ser um valor numérico',
            'custo_processo.numeric' => 'O campo custo do processo deve ser um valor numérico',
    ];

    public function rules(){
        return [
            'numero' => 'required|unique:processos',
            'dt_inicio' => 'required|date_format:d/m/Y', 
            'vara' => 'required',
            'valor_pedido' => 'required|numeric',
            'status' => 'required', 
            'usuario_id' => 'required', 
            'advogado_id' => 'required',
            'comissao' => 'numeric',
            'valor_realiado' => 'numeric',
            'custo_processo' => 'numeric',
        ];

    }
    
    public function beforeSave(){
        $patternDateFormat = "/^\d{4}\-\d{2}\-\d{2}$/";
        try{
            if($this->dt_inicio != null && !preg_match($patternDateFormat, $this->dt_inicio)){
                $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $this->dt_inicio);
                $this->dt_inicio = $dt->format("Y-m-d");
            }

        }catch(\Exception $e){

            \Log::error("Erro before Save", [ $e->getMessage()]);

        }
    }

    public function setValorPedidoAttribute($value){
     if($value == ""){
        $this->attributes["valor_pedido"] = null;
        return;

     }
     $value = str_replace(".", "", $value);
     $this->attributes["valor_pedido"] = str_replace(",", ".", $value);
    }

    public function setComissaoAttribute($value){
        if($value == ""){
       
        $this->attributes["comissao"] = null;
        return;
        }
        $value = str_replace(".", "", $value);
        $this->attributes["comissao"] = str_replace(",", ".", $value);
       }
    
       public function setValorRealizadoAttribute($value){
        
        if($value == ""){
       
            $this->attributes["valor_realizado"] = null;
            return;
            }
                
        $value = str_replace(".", "", $value);
        $this->attributes["valor_realizado"] = str_replace(",", ".", $value);
       }
    
       public function setCustoProcessoAttribute($value){
        if($value == ""){
       
            $this->attributes["custo_processo"] = null;
            return;
            }

        $value = str_replace(".", "", $value);
        $this->attributes["custo_processo"] = str_replace(",", ".", $value);
       }   

    /**
     * Get the advogado that owns the Processo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advogado(): BelongsTo
    {
        return $this->belongsTo(Advogado::class, 'advogado_id');
    }

    /**
     * Get the advogado that owns the Processo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * The reus that belong to the Processo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reus(): BelongsToMany
    {
        return $this->belongsToMany(Reu::class, 'reu_processo', 'processo_id', 'reu_id');
    }

    /**
     * The autores that belong to the Processo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autor_processo', 'processo_id', 'autor_id');
    }
}
