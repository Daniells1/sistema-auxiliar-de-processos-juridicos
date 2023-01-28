<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Autor;

use App\Models\Reu;

use App\Models\Advogado;

use App\Models\Usuario;

class PessoaController extends Controller
{
    public function autor(Request $request){
        $data = [];

        if($request->isMethod("POST")){
            try{
            $autor = new Autor($request->all());
            if(!$autor->save()){

                return back()->withErrors($autor->getErrors());

            }
            $request->session()->flash("success", "Autor cadastrado com sucesso!");
        }catch(\Exception $e){
            \Log::error("Erro save autor", [$e->getMessage()]);
            $request->session()->flash("error", "Autor não cadastrado!");

        }
        return redirect()->route('admin.pessoas.autor');
        }

        $lista = Autor::all();
        $data["lista"] = $lista;

        return view("admin/pessoas/autor", $data);
    }

    public function reu(Request $request){
        $data = [];

        if($request->isMethod("POST")){
            try{
                $reu = new Reu( $request->all() );
                if(!$reu->save()){
                    return back()->withErrors($reu->getErrors());

                }
                $request->session()->flash("success", "Reu cadastrado com sucesso!");

            }catch(\Exception $e){
                \Log::error("Erro save reu", [$e->getMessage()]);
                $request->session()->flash("error", "Réu não cadastrado!");
    

            }
            return redirect()->route('admin.pessoas.reu');
        }
        $lista = Reu::all();
        $data["lista"] = $lista;

        return view("admin/pessoas/reu", $data);
    }

    public function advogado(Request $request){
        $data = [];

        if($request->isMethod("POST")){
            try{
                \DB::beginTransaction();
                $senha = $request->input("senha");
                $csenha = $request->input("csenha");

               if($senha == "" || $senha != $csenha){
               $request->session()->flash("error", "Senhas não podem ser vazias e nem diferentes");
               return back();
        }

        $usuario = new Usuario;
       

        $usuario->email = $request->input("email");
        $usuario->status = "ATIVO";
        $usuario->password = \Hash::make($senha);
        $usuario->perfil = "FUNC";
         
        if(!$usuario->save()){
            \DB::rollback();
            return back()->withErrors($usuario->getErrors());
        }




                $advogado = new Advogado($request->all());
                $advogado->usuario()->associate($usuario);
                if(!$advogado->save()){
                    \DB::rollback();
                    return back()->withErrors($advogado->getErrors());
                }

                $request->session()->flash("success", "Advogado cadastrado com sucesso!");
                \DB::commit();

            }catch(\Exception $e){
                \DB::rollback();
                \Log::error("Erro save advogados", [ $e->getMessage()]); 
                $request->session()->flash("error", "Advogado não cadastrado!");

            }
            
            return redirect()->route('admin.pessoas.advogado');
        }
        $lista = Advogado::all();
        $data["lista"] = $lista;
        return view("admin/pessoas/advogado", $data);
    }

    
}
