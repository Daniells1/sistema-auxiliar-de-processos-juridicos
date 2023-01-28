@extends("admin.layout")
@section("conteudo") 
<style>
    .btn-detalhes-processo > i, .btn-detalhes-processo > svg{
        pointer-events:none;
    }
</style>

    <div class="card mt-3 mb-3 " >
    <div class="card-header">
         Buscar Processo
                                        
        </div>
        <div class="card-body">
            <form action="{{ route('admin.processos.buscar') }}" method="GET">
               
                <div class="row mt-2">

                <div class="col-4">
                 <div class="form-floating">
                    <input type="text" class="form-control" name="numero" id="numero">
                    <label for="numero">Número do Processo</label>
                 </div>
                </div>

                <div class="col-4">
                 <div class="form-floating">
                    <input type="text" class="form-control" name="vara" id="vara">
                    <label for="vara">Vara</label>
                 </div>
                </div>

                <div class="col-4">
                 <div class="form-floating">
                    <select name="status" id="status" class="form-control">
                        <option value=""></option>
                        <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                        <option value="GANHO">GANHO</option>
                        <option value="PERDIDO">PERDIDO</option>
                        <option value="ACORDO">ACORDO</option>
                    </select>
                    <label for="status">Status</label>
                 </div>
                </div>

                </div>
              
                

                <div class="mt-4 mb-0">
                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Buscar Processo"></div>
                    </div>                     
            </form>
    
</div>
</div>
@if(isset($lista) && count($lista) > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Número</th>
            <th>Início</th>
            <th>Vara</th>
            <th>Valor Pedido</th>
            <th>Status</th>
            <th>Advogado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($lista as $proc)
    <tr>
        <td>{{ $proc->numero }}</td>
        <td>{{ Helper::formatDate($proc->dt_inicio) }}</td>
        <td>{{ $proc->vara }}</td>
        <td>{{ Helper::formatNumber($proc->valor_pedido) }}</td>
        <td>{{ $proc->status }}</td>
        <td>{{ $proc->advogado->nome }}</td>
        <td><a href="#" class="btn btn-sm btn-secondary btn-detalhes-processo " alt="Detalhes do Processo" data-value="{{ $proc->id }}"><i class="fa-solid fa-circle-info"></i></a>
        <a href="{{ route('admin.processos.audiencia', [ 'id'=> $proc->id ]) }}" class="btn btn-sm btn-success" alt="Alterar Processo"><i class="fa-solid fa-share-from-square"></i></a> </td>
    </tr>

    @endforeach

</tbody>
</table>
{{ $lista->appends(request()->query())->links('admin._pagination') }}

@endif

<script>
  
  const detalheProcesso = (event) => {
    let modal = new bootstrap.Modal( document.querySelector("#modal-sistema"))
    modal.show()

    let idprocesso = event.target.getAttribute("data-value")

    document.querySelector("#modal-title").innerHTML = "Detalhes do Processo"
    fetch("{{ route('admin.processos.detalhes') }}?idprocesso=" + idprocesso)
    .then(result => result.text()  )
    .then( result => document.querySelector("#conteudo-modal").innerHTML = result)
    .catch( error => {
        console.log(error)
        alert("Detalhes do processo não puderam ser carregados")
    })
  }
  
  document.querySelectorAll(".btn-detalhes-processo").forEach(item => {
    item.addEventListener("click", event => detalheProcesso(event))
  })

 </script> 

@endsection