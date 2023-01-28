<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login no Sistema de Advogados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<style>
    html, body{
        height:100vh;

    }
</style>
</head>
<body>
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-6 mx-auto">
                <div class="card">
                <div class="card-header bg-warning text-white ">ESQUECEU SENHA DO SISTEMA</div>
                <div class="card-body">

                @if(Session::has("error") && Session::get("error") != "")
                <div class="alert alert-info">
                    {{ Session::get("error") }}
                </div>
                @endif

               
                <form action="{{route('esqueceu-senha')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="login">Informe o Login</label>
                        <input type="text" name="login" id="login" class="form-control">
                    </div>

                   
                     <div class="d-flex justify-content-md-end mt-2 gap-3">
                    <input type="submit" value="Enviar Senha" class=" btn btn-primary btn-sm ">
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">Logar no Sistema</a>
                        
                  </div>
                </form>
          </div>
        </div>
       </div>
     </div>
    </div>
</body>
</html>