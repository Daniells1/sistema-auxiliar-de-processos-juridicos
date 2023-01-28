@extends("admin.layout")
@section("conteudo")                        
                        <h1 class="mt-4">Novo Usuário</h1>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                     Formulário do Usuário
                                        
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action = "{{ route('admin.usuarios.novoSave')  }}">
                                            @csrf
                                       
                                    <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="inputEmail" type="text" name="email" placeholder="Informe seu E-mail" />
                                                        <label for="inputEmail">E-mail</label>
                                                    </div>
                                                </div>

                                         
                                                <div class="col-4">
                                                    <div class="form-floating ">
                                                        <input class="form-control" id="inputSenha" type="password"  name="senha" placeholder="Informe sua Senha" />
                                                        <label for="inputSenha">Senha</label>
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
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Salvar Usuário"></div>
                                            </div>
                                            </form>
                                        
                                    </div>
                                </div>
                            </div>  
                        </div>
                 <script>
                    const maskMoney = (value) => {
    value = value.replace(".", "").replace(",","").replace(/\D/g, "")
    const result = new Intl.NumberFormat("pt-BR", { minimumFractionDigits: 2})
    .format( parseFloat(value) / 100)
    return result
}

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
                