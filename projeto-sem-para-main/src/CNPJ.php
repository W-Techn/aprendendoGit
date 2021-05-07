<?php

    class CNPJ
    {
        public $cnpj;

    public function __construct($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function segundoDigitoCNPJehValido() {
        
        $sum = [];
        $c = 4;
        $d = 12;

        for ($counter= 2; $counter <= 6; $counter++) { 
            $sum[] = $counter * $this->cnpj[$c];
            $c--;
        }
        for ($encimera= 2; $encimera <= 9; $encimera++) { 
            $sum[] = $encimera * $this->cnpj[$d];
            $d--;
        } 
    $param = array_sum($sum) % 11; //armazena em uma varável, o valor do resto da divisão da soma de cada elemento da nossa lista criada por 11;
    if ($param < 2) { 
        if ($this->cnpj[13] == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        if ($this->cnpj[13] == 11 - $parametroSegundoDigito) {
            return true;
        } else {
            return false;
        }

    }
    } 
    }