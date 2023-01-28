@extends("admin.layout")

@section("conteudo")

<div class="card mt-3 mb-3 " >
    <div class="card-header">
         Relatório de Advogado - Processos Ganho ou Acordos
                                        
        </div>
        <div class="card-body">

        @if(isset($lista) && count($lista) > 0)

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Advogado do Processo</th>
            <th>Total Pedido</th>
            <th>Total Recebido</th>
            <th>Total do Custo</th>
            <th>Total Comissão</th>
            <th>Total Líquido</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lista as $rel)

        <tr>
            <td>{{ $rel->nome }} ( {{ $rel->total_processo }} )</td>
            <td>{{ Helper::formatNumber($rel->total_pedido) }}</td>
            <td>{{ Helper::formatNumber($rel->total_realizado) }}</td>
            <td>{{ Helper::formatNumber($rel->total_custo) }}</td>
            <td>{{ Helper::formatNumber($rel->total_comissao) }}</td>
            <td>{{ Helper::formatNumber($rel->total_liquido) }}</td>

        </tr>

        @endforeach
    </tbody>
</table>

@endif

</div>
</div>

@endsection