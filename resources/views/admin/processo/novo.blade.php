@extends("admin.layout")
@section("conteudo") 

    <div class="card mt-3 mb-3 " >
    <div class="card-header">
         Novo Processo
                                        
        </div>
        <div class="card-body">
            <form action="{{ route('admin.processos.processo-save') }}" method="post">
                @csrf
                <div class="accordion accordion-flush">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#telaprocesso">
                        Processo
                        </button>
                       
                    </h2>
                    <div id="telaprocesso" class="accordion-collapse collapse">

                    <div class="row mb-2 mt-2">
                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="numero" name="numero">
                            <label for="numero">Número do Processo</label>
                        
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="vara" name="vara">
                            <label for="vara">Vara</label>
                        
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="dt_inicio" name="dt_inicio" data-mask="99/99/9999">
                            <label for="dt_inicio">Data de ínicio</label>
                        
                        </div>
                    </div>
                     </div>

                    <div class="row mb-2">
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="valor_pedido" name="valor_pedido">
                            <label for="valor_pedido">Valor Pedido</label>
                        
                        </div>
                    </div>

                    @can("adm", \Auth::user())
                     
                    <div class="col-6">
                        <div class="form-floating">
                            <select name="advogado" id="advogado" class="form-control">
                              
                                <option value=""></option>
                                @if(isset($listaAdvogados) && count($listaAdvogados) > 0)
                                   @foreach($listaAdvogados as $adv)
                                   
                                   <option value="{{ $adv->id }}">{{ $adv->nome }}</option>
                                   @endforeach
                                @endif
                            </select>
                            <label for="advogado">Advogado</label>
                        
                        </div>
                    </div>
                     @endcan
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="comissao" name="comissao">
                            <label for="comissao">Comissão</label>
                        
                        </div>
                    </div>

                   
                 <div class="row mb-2 mt-2">
                  <div class="col-12">
                        <div class="form-floating">
                            <textarea  class="form-control" id="peticao_inicial" name="peticao_inicial" style="height: 200px"></textarea>
                            <label for="peticao_inicial">Petição Inicial</label>
                        
                        </div>
                    </div>
                    </div>

                    

                </div>
                </div>
                        
                    </div>

                    <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#telaautor">
                        Autor
                        </button>
                       
                    </h2>
                    <div id="telaautor" class="accordion-collapse collapse">
                        <div class="row mb-2 mt-2">
                            <div class="col-12">
                        @if(isset($listaAutor) &&  count($listaAutor) > 0)
                        
                        @foreach($listaAutor as $autor)
                         <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="autor[]" id = "autor{{ $autor->id }}" value="{{ $autor->id }}">
                            <label for="autor{{ $autor->id }}" class="form-check-label">{{ $autor->nome }} / {{ $autor->cpf_cnpj }}</label>
                         </div>
                        @endforeach

                        @endif
                        </div>
                        </div>
                    </div>
                  </div>


                    <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#telareu">
                        Réu
                        </button>
                       
                    </h2>
                    <div id="telareu" class="accordion-collapse collapse">
                   
                    <div class="row mb-2 mt-2">
                            <div class="col-12">
                        @if(isset($listaReu) &&  count($listaReu) > 0)
                        
                        @foreach($listaReu as $reu)
                         <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="reu[]" id = "reu{{ $reu->id }}" value="{{ $reu->id }}">
                            <label for="reu{{ $reu->id }}" class="form-check-label">{{ $reu->nome }} / {{ $reu->cpf_cnpj }}</label>
                         </div>
                        @endforeach

                        @endif
                        </div>
                        </div>

                    </div>

         




                </div>

                <div class="mt-4 mb-0">
                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Processo"></div>
                    </div>                     
            </form>
    
</div>
</div>


<script>
     const maskMoney = (value) => {
    value = value.replace(".", "").replace(",","").replace(/\D/g, "")
    const result = new Intl.NumberFormat("pt-BR", { minimumFractionDigits: 2})
    .format( parseFloat(value) / 100)
    return result
}

    let input = document.querySelector("#valor_pedido")
    input.addEventListener("keyup", (event) => {
        event.target.value = maskMoney(event.target.value)
    })

    let comissao = document.querySelector("#comissao")
    comissao.addEventListener("keyup", (event) => {
        event.target.value = maskMoney(event.target.value)
    })


const format = (field, event) => {
    if(event.keyCode == 8) return ; //SAIA DA FUNÇÃO

    let key = event.key //Valor atual que foi digitado

    let mask = field.getAttribute("data-mask") //Pegar a mascara definida no campos
    let value = field.value //Valor total da Stirng que esta no campo
    let tamString = value.length // tamanho da string que esta no vampos

    let keyMask = mask.charAt(tamString) //O valor referente ao tamanho da string em relação a mascara
    if(keyMask == "" || keyMask == null){
    event.preventDefault()
    return ;
    }

    switch(keyMask){
    case '9':
        /*
        Se valor esperado na mascara for 9, significa que o usuario deve inserir um numero
        se o valor queu usuario inseriu não foi um numero eu não vou aceitar (cancelar)
        */
        var regex = new RegExp("\\d")
        if(!regex.test(key)){
        event.preventDefault()
        return ;
        }
        break;
    case 'A':
        var regex = new RegExp("[a-z]", "i")
        if(!regex.test(key)){
        event.preventDefault()
        return ;
        }
        break;
    default :
        field.value = field.value + keyMask;
        format(field, event)
    }

}

document.querySelectorAll("[data-mask]").forEach((field) => {
    //let mask = e.getAttribute("data-mask")
    //console.log(mask)
    field.addEventListener("keydown", (event) => {
    format(field, event)
    })
})

 </script> 

@endsection