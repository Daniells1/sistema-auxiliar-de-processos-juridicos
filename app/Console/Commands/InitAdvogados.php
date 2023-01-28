<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitAdvogados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:init-project {user} {pass}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iniciar o projeto  de advogados e criar o usuario ADMIN inicial';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usuario = $this->argument("user");
        $senha = $this->argument("pass");

        echo "Command iniciado";
        echo "\nCadastrando o usuário " . $usuario . " no banco de dados";

        try{
            $dbUser = \App\Models\Usuario::where("email", $usuario)->first();
            if($dbUser){
                throw new \Exception("Usuário já cadastrado no banco de dados");

            }
            $dbUser = new \App\Models\Usuario();
            $dbUser->status = "ATIVO";
            $dbUser->nome = $usuario;
            $dbUser->email = $usuario;
            $dbUser->password = \Hash::make($senha);

            $dbUser->save();
            echo "\n\nUsuário inserido com sucesso!";


        }catch(\Exception $e){
            \Log::error("ERRO COMMAND InitAdvogados", [ $e->getMessage()]);
            echo "\n\nErro no command";
        }

        return 0;
    }
}
