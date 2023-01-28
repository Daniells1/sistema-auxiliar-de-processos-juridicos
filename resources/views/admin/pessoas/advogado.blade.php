@extends("admin.layout")
@section("conteudo")                        
                 
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                    Advogado
                                        
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
                                                <input type="text" class="form-control" name="nr_oab" id="nr_oab">
                                                <label for="nr_oab">Informe o Número da OAB</label>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="email" id="email">
                                                <label for="email">Informe o E-mail</label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="senha" id="senha">
                                                <label for="senha">Informe a Senha</label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="csenha" id="csenha">
                                                <label for="csenha">Confirme a Senha</label>
                                            </div>
                                        </div>

                                        
                                    </div>
                                           
                                    <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Advogado"></div>
                                            </div>
                                    </form>

                                    </div>
                                </div>
                                @if(isset($lista) && count($lista) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                             <th>Nome</th>
                                             <th>Número OAB</th>
                                             <th>E-mail</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lista as $adv)
                                        <tr>
                                        <td>{{ $adv->nome }}</td>
                                        <td>{{ $adv->nr_oab }}</td>
                                        <td>
                                            {{ optional($adv->usuario)->email }}
                                        </td>
                                            
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>  
                        </div>
@endsection
                  