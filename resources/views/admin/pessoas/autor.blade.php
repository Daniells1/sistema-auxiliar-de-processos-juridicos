@extends("admin.layout")
@section("conteudo")                        
                 
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                    Autor
                                        
                                    </div>
                                    <div class="card-body">
                                     
                                    <form method="post">
                                        @csrf
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="nome" id="nome">
                                                <label for="nome">Informe o Nome</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj">
                                                <label for="cpf_cnpj">Informe o Cpf/Cnpj</label>
                                            </div>
                                        </div>

                                        
                                    </div>
                                           
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="email" id="email">
                                                <label for="email">Informe o E-mail</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="telefone" id="telefone">
                                                <label for="telefone">Informe o Telefone</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Autor"></div>
                                            </div>
                                    </form>

                                    </div>
                                </div>
                                @if(isset($lista) && count($lista) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                             <th>Nome</th>
                                            <th>Cpf/Cnpj</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lista as $a)
                                        <tr>
                                        <td>{{ $a->nome }}</td>
                                            <td>{{ $a->cpf_cnpj }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>
                                               {{ $a->telefone }}
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>  
                        </div>
@endsection
                  