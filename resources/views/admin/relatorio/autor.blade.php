@extends("admin.layout")

@section("conteudo")

<div class="card mt-3 mb-3 " >
    <div class="card-header">
         Relatório de Autor
                                        
        </div>
        <div class="card-body">
            @if(isset($lista) && count($lista) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Total de Processos</th>
                        <th>Número dos Processos</th>
                    </tr>
                </thead>
                @foreach($lista as $autor)
                <tbody>
                    <tr>
                        <td>{{ $autor->nome }}</td>
                        <td>{{ $autor->total }}</td>
                        <td>
                            <ul>
                        @foreach(Str::of($autor->num_processos)->explode(",") as $proc)    
                        <li>{{ $proc }}</li>
                        @endforeach

                        </ul>
                    
                    </td>
                    </tr>
                </tbody>

                @endforeach
            </table>

            @endif

</div>
</div>

@endsection