<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Hash;

class SistemaController extends Controller
{
    public function index(){
        return view('admin/index');
    }

    public function meusDados(Request $request){
        
        $data = [];
        $usuario = Auth::user();

        if($request->isMethod("POST")){
            $email = $request->input("email");
            $nome = $request->input("nome");
            $senha = $request->input("senha");
            $novasenha = $request->input("novasenha");
            $csenha = $request->input("csenha");
            $nr_oab = $request->input("nr_oab");

            if($novasenha == "" || $novasenha != $csenha){
                $request->session()->flash("error", "Senhas não podem ser vazias e nem diferentes");
                return redirect()->route("admin.meus-dados");
            }

          
            if(!Hash::check($senha, $usuario->password)){
                $request->session()->flash("error", "Senha atual é inválida");
                return redirect()->route("admin.meus-dados");
                
            }

            \DB::beginTransaction();
         $usuario->email = $email;
         //$usuario->nome = $nome;
         $usuario->password = Hash::make($novasenha);
         if(!$usuario->save()){
            \DB::rollback();
            return back()->withErrors($usuario->getErrors());

         }

         Auth::login($usuario);

         if($usuario->perfil == "FUNC"){
            $advogado = $usuario->advogado;
            $advogado->nome = $nome;
            $advogado->nr_oab = $nr_oab;

            if(!$advogado->save()){
                \DB::rollback();

                return back()->withErrors($advogado->getErrors());
    
             }
         }

         $request->session()->flash("success", "Usuário alterado com sucesso!");
         \DB::commit();

         return redirect()->route("admin.meus-dados"); 

        }
        $data["usuario"] = $usuario;
        return view("admin/meus-dados", $data);

    }
}
