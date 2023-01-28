@extends("admin.layout")

@section("conteudo")

<div class="card mt-3 mb-3 " >
    <div class="card-header">
         Relatório de Processo
                                        
        </div>
        <div class="card-body">

        @if(isset($lista) && count($lista) > 0)
        <a href="{{ route('admin.relatorio.processo-pdf') }}" class="btn btn-secondary btn-sm mb-2">Download PDF</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Status do Processo</th>
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
                    <td>{{ $rel->status }} ( {{ $rel->total }} )</td>
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