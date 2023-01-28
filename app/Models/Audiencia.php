<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Audiencia extends BaseModel
{
    protected $table = "audiencias";
    protected $fillable = ['dt_audiencia', 'hr_audiencia', 'observacao', 'processo_id'];

    protected $messages =[
        'dt_audiencia.required' => 'O campo data da audiência é obrigatório',
        'hr_audiencia.required' => 'O campo hora da audiência é obrigatório',
        'dt_audiencia.date_format' => 'O campo data da audiência deve ser uma data',
        'hr_audiencia.required' => 'O campo hora da audiência deve ser uma hora',
    ];

    public function rules(){
        return [
            "dt_audiencia" => 'required|date_format:d/m/Y',
            "hr_audiencia" => 'required|date_format:H:i'

        ];
    }
    
    public function beforeSave(){
        $patternDateFormat = "/^\d{4}\-\d{2}\-\d{2}$/";
        try{
            if($this->dt_audiencia != null && !preg_match($patternDateFormat, $this->dt_audiencia)){
                $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $this->dt_audiencia);
                $this->dt_audiencia = $dt->format("Y-m-d");
            }

        }catch(\Exception $e){
            \Log::error("Erro before save audiencia", [ $e->getMessage() ]);

        }
        
    }

    /**
     * Get the processo that owns the Audiencia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function processo(): BelongsTo
    {
        return $this->belongsTo(Processo::class, 'processo_id');
    }
}
