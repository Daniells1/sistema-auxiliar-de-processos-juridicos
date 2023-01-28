<?php

namespace App\Policies;

use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function adm(Usuario $usuario){
        return $usuario->perfil == "ADMIN";
    }

    public function funcionario(Usuario $usuario){
        return in_array($usuario->perfil, [ 'ADMIN', 'FUNC']);
    }
}
