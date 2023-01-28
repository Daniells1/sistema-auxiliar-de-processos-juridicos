<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;




class PrevisaoPagamentoProcesso extends BaseModel
{
    protected $table = "previsao_pagamento_processos";
    protected $fillable = ["vl_pago", "dt_pagamento", "advogado_id", "processo_id"];

    protected $messages = [
        'vl_pago.required' => 'Campo  é valor pago é obrigatório',
        'vl_pago.numeric' => 'Campo valor pago deve ser um valor numérico',
        'dt_pagamento.required' => 'Campo data de pagamento é obrigatório',
        'dt_pagamento.date_format' => 'O campo data de pagamento deve ter uma data válida',

    ];

    public function rules(){
        return [
            'vl_pago' => 'required|numeric',
            'dt_pagamento' => 'required|date_format:d/m/Y'
        ];

    }


    public function beforeSave(){
        //é o padrão da data do banco de dados ---- yyyy-mm-dd
        $patternDateFormat = "/^\d{4}\-\d{2}\-\d{2}$/";
        try{
            if($this->dt_pagamento != null && !preg_match($patternDateFormat, $this->dt_pagamento)){
                $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $this->dt_pagamento);
                $this->dt_pagamento = $dt->format("Y-m-d");

            }

        }catch(\Exception $e){

            \Log::error("Erro before Save", [ $e->getMessage()]);

        }
    

    }

    /**
     * Get the Processo that owns the PrevisaoPagamentoProcesso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processo(): BelongsTo
    {
        return $this->belongsTo(Processo::class, 'processo_id');
    }
    
    /**
     * Get the advogado that owns the PrevisaoPagamentoProcesso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advogado(): BelongsTo
    {
        return $this->belongsTo(Advogado::class, 'advogado_id');
    }
   
}
