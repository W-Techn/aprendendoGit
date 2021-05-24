<?php
// tendo em mente que só precisamos fazer a verificação de um dígito digito verificador (o segundo), vamos pular a declaração da verificação do primeiro
    class CNPJ //damos início então a classe de cri-
    { //ação de CNPJ 
        public $cnpj; 

    public function __construct($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function segundoDigitoCNPJehValido() {
        
        $sum = []; //inicializamos uma lista que irá abrigar as multipicações de chave e valor
        $c = 4; //essa variável sera usado para multiplicar os quatro primeiros digitos
        $d = 12; //e esta será para analizar o valor inteiro menos os 4 já calculados
        //serão feitos dois laços, pois o valor será dividido em duas partes
        for ($counter= 2; $counter <= 6; $counter++) { //é iniciado um contador que pega valores de 5 até 2 e multiplica com os subsequentes 4 digitos da posição indicada pela constante $c
            $sum[] = $counter * $this->cnpj[$c];
            $c--; //esse valor é adicionado na lista $sum
        }
        for ($encimera= 2; $encimera <= 9; $encimera++) { //depois é iniciado o segundo contador que pega valores de 9 até 2 e multiplica com os subsequentes digitos que restaram pela posição indicada pela constante $d
            $sum[] = $encimera * $this->cnpj[$d];
            $d--; //esses valores são armazenados na lista $sum
        } 
    $param = array_sum($sum) % 11; //armazena em uma varável, o valor do resto da divisão da soma de cada elemento da nossa lista criada por 11;
    if ($param < 2) { //caso o resto dessa divisão for menor que 2
        if ($this->cnpj[13] == 0) { //o resultado deverá ser  zero, senão, o digito verificador não será válido; 
            return true;
        } else {
            return false;
        }
    } else {
        if ($this->cnpj[13] == 11 - $param) { //caso o resto dessa divisão seja maior que 2, o primeiro dígito
            return true; //após o traço deverá ser a diferença de 11 e esse resto, ou então não será válido;
        } else {
            return false;
        }

    }
    } 
    }
