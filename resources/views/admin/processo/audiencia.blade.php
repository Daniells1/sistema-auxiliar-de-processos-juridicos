@extends("admin.layout")
@section("conteudo")

<style>
    .detalhes label{
        display:block;
        font-weight:bold;

    }

    .detalhes .row {
        margin-bottom: 1rem;

    }

    
</style>
@if($processo->status == "EM ANDAMENTO")
   
    <div class="card mt-2 mb-2">
        <div class="card-header">
             Audiência
        </div>
        <div class="card-body">
            <form action="{{ route('admin.processos.audiencia-save', [ 'id'=> $processo->id] ) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" name="dt_audiencia" id="dt_audiencia" class="form-control" data-mask="99/99/9999">
                            <label for="dt_audiencia">Data da Audiência</label>
                        </div>
</div>
                        <div class="col-4">
                        <div class="form-floating">
                            <input type="text" name="hr_audiencia" id="hr_audiencia" class="form-control" data-mask="99:99">
                            <label for="hr_audiencia">Hora da Audiência</label>
                        </div>    
                   </div>

                   <div class="col-4">
                        <div class="form-floating">
                        <select name="status" id="status" class="form-control">
                        <option value=""></option>
                        <option @if($processo->status == "EM ANDAMENTO") selected @endif value="EM ANDAMENTO">EM ANDAMENTO</option>
                        <option @if($processo->status == "GANHO") selected @endif value="GANHO">GANHO</option>
                        <option @if($processo->status == "PERDIDO") selected @endif value="PERDIDO">PERDIDO</option>
                        <option @if($processo->status == "ACORDO") selected @endif value="ACORDO">ACORDO</option>
                    </select>
                    <label for="status">Status</label>
                        </div>    
                   </div>
                    
                </div>

                <di class="row mt-2">
                    <div class="col-12">
                        <div class="form-floating">
                        <textarea name="observacao" id="observacao" class="form-control" style="height: 200px"  rows="10"></textarea>
                        <label for="observacao">Observação</label>
                        </div>
                    </div>
                </di>

                
                <div  id="encerrar_processo">
                
                   <div class="row mt-2">

                   <div class="col-6">  
                   <div class="form-floating">
                            <input type="text" name="valor_realizado" id="valor_realizado" class="form-control" >
                            <label for="valor_realizado">Valor Realizado</label>
                        </div>
                    </div> 

                    <div class="col-6">  
                   <div class="form-floating">
                            <input type="text" name="custo_processo" id="custo_processo" class="form-control" >
                            <label for="custo_processo">Custo Processo</label>
                        </div>
                    </div> 
                    </div>
                    <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-floating">
                        <textarea name="peticao_final" id="peticao_final" class="form-control" style="height: 200px"  rows="10"></textarea>
                        <label for="peticao_finall">Petição Final</label>
                        </div>
                    </div>
                </div>
            </div>



                <div class="mt-2 mb-0">
                <div class="d-grid">
                <input type="submit" value="Salvar Audiência" class="btn btn-primary">
                </div>
                </div>

            </form>
        </div>
    </div>
@endif
  
@include('admin.processo._processo', [ 'processo' => $processo])

    <div class="card mt-2 mb-2">
        <div class="card-header">
             Histórico de Audiência
        </div>
        <div class="card-body">
            @if(isset($listaAudiencia) && count($listaAudiencia) > 0)

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data da Audiência</th>
                        <th>Hora</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listaAudiencia as $aud)
                    <tr>
                        <td>{{ Helper::formatDate($aud->dt_audiencia)}}</td>
                        <td>{{ $aud->hr_audiencia }}</td>
                        <td>{{ $aud->observacao }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

            @endif
        </div>
    </div>

<script>

  let input = document.querySelector("#valor_realizado")
    input.addEventListener("keyup", (event) => {
        if(isNaN(event.key)) return ;
        event.target.value = maskMoney(event.target.value)
    })

    let custo_processo = document.querySelector("#custo_processo")
    custo_processo.addEventListener("keyup", (event) => {
        if(isNaN(event.key)) return ;
        event.target.value = maskMoney(event.target.value)

    })

    document.querySelector("#encerrar_processo").style.display = 'none'
    document.querySelector("#status").addEventListener('change', (event) => {
        let status = event.target.value

        if(status == "" || status == "EM ANDAMENTO"){

            document.querySelector("#encerrar_processo").style.display = 'none'

        }else{

            document.querySelector("#encerrar_processo").style.display = 'block'

        }
    })
</script>
@endsection