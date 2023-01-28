@extends("admin.layout")
@section("conteudo")                        
                 
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                    Réu
                                        
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

                                    <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Réu"></div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lista as $r)
                                        <tr>
                                        <td>{{ $r->nome }}</td>
                                        <td>{{ $r->cpf_cnpj }}</td>
                                            
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>  
                        </div>
@endsection
                  