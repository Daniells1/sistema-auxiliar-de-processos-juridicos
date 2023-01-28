<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Usuario;


class LoginController extends Controller
{
    public function index(Request $request){
        $data = [];
        if($request->isMethod("POST")){
            $login = $request->input("login");  
            $senha = $request->input("senha");
            
            if(Auth::attempt(['email' => $login, 'password' => $senha, 'status' => 'ATIVO'])){
                return \redirect()->route("admin.home");
        }else{
           $request->session()->flash("error", "Login / Senha Inválidos");
           return \redirect()->route("home");
        }
       
    }
    return view("login", $data);
}
    public function esqueceuSenha(Request $request){
        $data = [];

        if($request->isMethod("post")){
            $login = $request->input("login", "");
            $newPass = \Str::random(10);

            $user = Usuario::where("email", $login)->first();
            if(!$user){

                $request->session()->flash("error", "Login Inválido");
                return \redirect()->route("esqueceu-senha");

            }
            $user->password = \Hash::make($newPass);
            if( !$user->save()){

                $request->session()->flash("error", "Não pode gerar uma senha para o usuário,entre 
                em contato com a administração");
            return \redirect()->route("esqueceu-senha");

            }
            

            \Mail::send('email.forget-password', ['login' => $login, 'nome' => $user->nome, 'senha' => $newPass], 
            function($message) use($login){
            $message->from("contato@projetoadvogados.com.br");
            $message->to($login);
            $message->subject("Reset de senha");
            });

            $request->session()->flash("error", "Nova senha enviada para o E-mail");
            return \redirect()->route("esqueceu-senha");
        }
        return view("esqueceu-senha", $data);

    }

    public function logout(){
        Auth::logout();
        return \redirect()->route("home");
    }
}
