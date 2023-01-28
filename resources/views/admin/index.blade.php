
@extends("admin.layout")
@section("conteudo")                        
                        <h1 class="mt-4">S.A.P.J - Sistema Auxiliar de Processos Jurídicos</h1>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                     Dados do Usuário Logado
                                        
                                    </div>
                                    <div class="card-body">
                                        @php 
                                         $user = \Auth::user();
                                        @endphp
                                        <p>
                                        Nome: {{ $user->nome }}
                                        </p>
                                        <p>
                                        Login: {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>  
                        </div>
@endsection
                  