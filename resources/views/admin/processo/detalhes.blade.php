
<style>
    .detalhes label{
        display:block;
        font-weight:bold;

    }

    .detalhes .row {
        margin-bottom: 1rem;

    }

    
</style>

@include('admin.processo._processo', [ 'processo' => $processo])

    @if(isset($listaAudiencia) && count($listaAudiencia) > 0)
    <div class="card mt-2 mb-2">
        <div class="card-header">
             Histórico de Audiência
        </div>
        <div class="card-body">
           

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


