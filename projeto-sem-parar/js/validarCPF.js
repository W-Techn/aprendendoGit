//este arquivo de Javascript manipulará o CPF e o CNPJ inserido. 
var inputNumero = document.querySelector('input[name=chave]');  //vamos selecionar os campos
var campoNumero = document.querySelector('input#CPF.form-ctrl'); //os inputs
var msg = document.querySelector('#fail'); //as mensagens d'erro
var msg2 = document.querySelector('#fail2');
var submit = document.querySelector('input#botao'); // e o botão de submit
//para nós criarmos funções que irão responder a esses eventos
function validaCPF(lista) { //essa função ira validar o CPF, receberá uma lista como parâmetro
    let toAdd = []; //aqui temos uma lista que irá adicionar e somar valores
    let a = 9; //varável que irá compor o index do elemento em questão
    
    for (let index = 2; index <= 11; index++) { //aqui será iniciado um contador que vai pegar os dez valores da lista 
        toAdd.push(index * lista[a]); //e multiplicará por cada numero correspondente 
        a--; //em ordem decrescente
    }
    const total = toAdd.reduce(function (anterior, atual) { 
        return anterior + atual 
    }) 
    let param = total % 11 //daí pegamos esse resultado, dividimos por 11 e armazenamos o resto e um variável de parametro
    if (param < 2) { //se esse valor for menor que 2
        if (lista[10] == 0) { //o segundo digito verificador TEM que ser 0
            return true;
        } else {
            return false; //caso contrário o CPF está inválido
        }
    } else { //caso contrário
        if (lista[10] == 11 - param) { //esse valor só estará correto se ele for o resultado da diferença entre 11 e esse parâmetro  
            return true;
        } else{
            return false;
        }
    }
}
function validaCNPJ(lista) { //a função que valida o CNPJ é a mesma coisa, com algumas ressalvas
    let aSomar = [];
    let b = 4; //faremos dois laços que serão adicionados na mesma lista, um para os cinco primeiros digitos,
    let c = 12; //outra para o restante
    
    for (let counter = 2; counter <= 6; counter++) { //o primeiro laço ira multiplicar os cinco primeiros
        aSomar.push(counter * lista[b]); //pelos numeros de 2 a 6
        b--;
    }
    for (let contador = 2; contador <= 9; contador++) { // os números restantes serão multiplicados 
        aSomar.push(contador * lista[c]); //por seus repectivos valores de 2 a 9
        c--;
    }
    const sum = aSomar.reduce(function (anterior, atual) { //aqui é repetida a função de soma por meio de reduce, que recebe dois valores precentes
        return anterior + atual //e retorna a soma dele, depois repete o procedimento até o resto da lista
    }) 
    let parametro = sum % 11 
    if (parametro < 2) {
        if (lista[13] == 0) { //lembrando que no CNPJ, os dígitos verificadores são os dois últimos, após o traço, e não após a barra
            return true;
        } else {
            return false;
        }
    } else {
        if (lista[13] == 11 - parametro) {
            return true;
        } else{
            return false;
        }
    }
}

inputNumero.addEventListener("input", function() { // agora vamos adicionar um escutador de eventos para o campo de input

    if (inputNumero.value.length == 14 || inputNumero.value.length == 17) { //e vamos fazer uma verificação com base no tamanho dos números digitados
        var formatted = inputNumero.value.replace('.', '').replace('.', '').replace('–', ''); //depois vamos fazer uma filtragem de todos os caracteres especiais que possuir
        console.log(formatted); 
        var lista = formatted.split(""); //e vamos transformar em uma lista para que possamos para por parâmetro nas funções fr validação
        switch (lista.length) { //um laço switch será usado para verificar se  
            case 11: //pelo tamanho da lista
                var validCpf = validaCPF(lista); //se trata de um CPF 
                if (validCpf == true) { //e aí nós chamaremos a função que valida, e caso passe
                    campoNumero.style.borderColor = "#474746"; //pegaremos o campo de iput e alteraremos a tua cor para a cor padrão, para simular o efieto de aprovação para quem está acessando
                    msg.textContent = ""; //removeremos a mensagem d'erro
                    botao.classList.remove("disabled"); // e habilitaremos o botão de confirmar
                } else { //se não for válido,
                    campoNumero.style.borderColor = "darkred"; //destacaremos a borda do input de vermelho 
                    msg.style.color = "darkred"; //bem como a mensagem de,
                    msg.textContent = "*valor de CPF inválido"; //a mensagem de confirmação,
                    msg2.textContent = ""; //apagamos a mensagem de alerta de CNPJ (será implementado posteriormente)
                    botao.classList.add("disabled"); //e desabilitamos o botão de confirmação
                }
            break;
            case 14: //ou CNPJ,
               var validCnpj = validaCNPJ(lista); //onde chamaremos sua função de validação e repetiremos a exemplo do CPF
               if (validCnpj == true) {
                campoNumero.style.borderColor = "#474746";
                msg.textContent = "";
                botao.classList.remove("disabled");
                } else {
                campoNumero.style.borderColor = "darkred";
                msg.style.color = "darkred";
                msg.textContent = "*valor de CNPJ inválido";
                botao.classList.add("disabled");
                }
                break;
            default: //de maneira padrão, ou seja, quando o número de digitos inseridos no campo não indicar nem CPF ou CNPJ, essa região do formulário ficará desse estilo 
                campoNumero.style.borderColor = "#474746"; 
                msg.textContent = "";
                botao.classList.remove("disabled");
                break;
        }
    } 
         
});    