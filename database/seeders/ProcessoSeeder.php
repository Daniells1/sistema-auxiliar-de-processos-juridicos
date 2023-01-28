<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $advogado = \App\Models\Advogado::all()->random(1)->first();
        $usuario = \App\Models\Usuario::all()->random(1)->first();

        \DB::table("processos")->insert([
        'numero'=> Str::uuid(), 
        'dt_inicio' => \Carbon\Carbon::now()->format("Y-m-d"), 
        'peticao_inicial' => Str::random(100), 
        'vara' => Str::random(10), 
        'valor_pedido' =>rand(1000, 40000),
         'status' => "EM ANDAMENTO",
       
        'usuario_id' => $usuario->id, 
        'advogado_id' => $advogado->id]
    );
    }
}
