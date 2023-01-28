@extends("admin.layout")
@section("conteudo")                        
                        <h1 class="mt-4">Buscar Usuário</h1>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                     Buscar Usuário
                                        
                                    </div>
                                    <div class="card-body">
                                     
                                    <form method="post">
                                        @csrf

                                        
                                    <div class="row mt-3 mb-3">
                                                <div class="col-5">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="inputEmail" type="text" name="email" placeholder="E-mail para a pesquisa" />
                                                        <label for="inputEmail">E-mail</label>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputNome" type="text" name="nome" placeholder="Nome para a pesquisa" />
                                                        <label for="inputNome">Nome</label>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex align-items-center">
                                                    <input type="submit" value="Buscar" class="btn btn-secondary">
                                                </div>
                                            </div>

                                           
                                    </form>

                                    </div>
                                </div>
                                @if(isset($lista) && count($lista) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>E-mail</th>
                                            <th>Nome</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lista as $u)
                                        <tr>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->nome }}</td>
                                            <td>{{ $u->status }}</td>
                                            <td>
                                                @if($u->status == "ATIVO")
                                                 <a href="{{ route('admin.usuarios.ativar', ['ativo' => 1, 'id'=> $u->id])}}" class="btn btn-sm btn-danger">INATIVAR</a>
                                                @else
                                                <a href="{{ route('admin.usuarios.ativar', ['ativo' => 0, 'id'=> $u->id])}}" class="btn btn-sm btn-info">ATIVAR</a>
                                                @endif
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>  
                        </div>
@endsection
                  