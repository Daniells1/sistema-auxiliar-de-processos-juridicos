<div class="card mt-2 mb-2">
        <div class="card-header">
             Detalhes do Processos:
        </div>
        <div class="card-body detalhes">
            <div class="row">
            <div class="col-3">
             <label>Número do Processo:</label>
             {{ $processo->numero }}
            </div>

            <div class="col-3">
             <label >Início do Processo:</label>
             {{ Helper::formatDate($processo->dt_inicio) }}
            </div>

            <div class="col-3">
             <label >Vara:</label>
             {{ $processo->vara }}
            </div>

            <div class="col-3">
             <label >Status:</label>
             {{ $processo->status }}
            </div>
         </div>
         <div class="row">
            <div class="col-4">
                <label >Advogado:</label>
                {{ $processo->advogado->nome }}
            </div>

            <div class="col-4">
                <label >Usuário Cadastro:</label>
                {{ Helper::formatNumber($processo->valor_pedido) }}
            </div>

            <div class="col-4">
                <label >Usuário Cadastrado:</label>
                {{ $processo->usuario->nome }}
            </div>
         </div>

         <div class="row">
            <div class="col-4">
                <label>Comissão do Advogado</label>
                {{ $processo->comissao }}%

            </div>

            <div class="col-4">
                <label>Valor Realizado no Processo</label>
                {{ Helper::formatNumber($processo->valor_realizado) }}

            </div>

            <div class="col-4">
                <label>Custo do Processo</label>
                {{ Helper::formatNumber($processo->custo_processo) }}

            </div>
         </div>

         <div class="row">
            <div class="col-6">
                
                <label>Autor(es):</label>
                <ul>
                @foreach($processo->autores as $autor)

                <li>{{ $autor->nome }}</li>

                @endforeach
                </ul>
            </div>

            <div class="col-6">
                <label>Réu(s):</label>
                <ul>
                @foreach($processo->reus as $reu)

                <li>{{ $reu->nome }}</li>

                @endforeach
                </ul>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
                <label for="">Petição Inicial:</label>
                {{ $processo->peticao_inicial }}
            </div>
         </div>

         <div class="row">
            <div class="col-12">
                <label for="">Petição Final:</label>
                {{ $processo->peticao_final }}
            </div>
         </div>

         

        </div>
    </div>
