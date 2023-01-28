<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;



class UsuarioController extends Controller
{
    public function novo(Request $request){
        return view("admin/usuarios/novo");
    }

    public function novoSave(Request $request){
        try{
        $senha = $request->input("senha");
        $csenha = $request->input("csenha");

        if($senha == "" || $senha != $csenha){
            $request->session()->flash("error", "Senhas não podem ser vazias e nem diferentes");
            return redirect()->route("admin.usuarios.novo");
        }

        $usuario = new Usuario;
       

        $usuario->email = $request->input("email");
        $usuario->status = "ATIVO";
        $usuario->password = \Hash::make($senha);
        $usuario->perfil = "ADMIN";


        if(!$usuario->save()){
            return back()->withErrors($usuario->getErrors());
        }

        $request->session()->flash("success", "Usuário cadastrado com sucesso");
    }catch(\Exception $e){
       \Log::error("Save Usuario ", [ $e->getMessage()]); 
        $request->session()->flash("error", "Usuário não pode ser adastrado ");
    }
        return redirect()->route("admin.usuarios.novo");

    }

    public function buscar(Request $request){
        $data = [];

        if($request->isMethod("POST")){
            $email = $request->input("email");
       
            
            $usuario = new Usuario();
            $usuario->email = $email;
            $usuDao = new \App\Repository\UsuarioDao($usuario);
           
           
            $data['lista'] = $usuDao->search()
            ->limit(100)
            ->get();
            
                                    
        }
        return view("admin/usuarios/buscar", $data);
    }

    public function ativar($id, $ativo ,Request $request){
        try{
          $user = Usuario::find($id);
          if(!$user){
            $request->session()->flash("error", "Usuário não encontrado");
            return redirect()->route("admin.usuarios.buscar");
            
          }

          if($ativo == "1"){
            $user->status = "INATIVO";
          }else{
          $user->status = "ATIVO";
          }
          $user->save();
          $request->session()->flash("success", "Usuário alterado com sucesso");
  
        }catch(\Exception $e){
            \Log::error("Ativar Usuario ", [ $e->getMessage()]); 
            $request->session()->flash("error", "Usuário não pode ser alterado ");
        }
        return redirect()->route("admin.usuarios.buscar");
  
      }
}
