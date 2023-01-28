@extends("admin.layout")
@section("conteudo")                        
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                     Meus Dados
                                        
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            @csrf
                                       
                                    <div class="row mb-3">
                                                <div class="{{ $usuario->advogado ? 'col-4' : 'col-12' }}">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="inputEmail" type="text" name="email" placeholder="Informe seu E-mail" value="{{ $usuario->email }}" />
                                                        <label for="inputEmail">E-mail</label>
                                                    </div>
                                                </div>
                                            @if( $usuario->perfil == "FUNC")
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputNome" type="text" name="nome" placeholder="Informe seu Nome" value="{{ $usuario->advogado->nome }}" />
                                                        <label for="inputNome">Nome</label> 
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="nr_oab" type="text" name="nr_oab" placeholder="Informe seu Número da OAB" value="{{ $usuario->advogado->nr_oab }}" />
                                                        <label for="nr_oab">Número OAB</label> 
                                                    </div>
                                                </div>
                                            
                                            @endif
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="inputSenha" type="password"  name="senha" placeholder="Informe sua Senha" />
                                                        <label for="inputSenha">Senha Atual</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="novasenha" type="password"  name="novasenha" placeholder="Informe sua Senha" />
                                                        <label for="novasenha">Nova Senha</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputCSenha" type="password" name="csenha" placeholder="Confirme sua Senha" />
                                                        <label for="inputCSenha">Confirmar Senha</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Meus Dados"></div>
                                            </div>
                                            </form>
                                        
                                    </div>
                                </div>
                            </div>  
                        </div>
@endsection
                  