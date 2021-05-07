<?php

    class CPF  //classe que terá função de criar um objeto do tipo CPF com funções para validar os últimaos dois dígitos;
    {
        public $cpf;

        public function __construct(array $cpf) //método mágico que constrói o objeto recebendo um array
        {;
            $this->cpf = $cpf; //depois que passado um array como parâmetro, este é passado para o atributo da classe
        }

        public function primeirodigitoehValido() //depois que o objeto é criado, esta função deve ser chamada para verificar
        {                                        //o primeiro número depois do traço de CPF;
            $aSomar = []; //uma lista vazia será criada;
            $i = 8; //esta variável vai servir pra localizar cada dígito do CPF;
            for ($contador = 2; $contador <= 10; $contador++) { //laço for é criado contendo um contador que vai de dois até 10; 
                $aSomar[] = $contador * $this->cpf[$i]; //na lista que foi criada, será adicionado a multiplicação do contador com a posição de cada digito do CPF em ordem decrescente
                $i--; //ou seja, cada digito será multiplicado pela sua posição se o CPF fosse escrito ao contrário, começando por 2;
            }
            $parametroPrimeiroDigito = array_sum($aSomar) % 11; //armazena em uma varável, o valor do resto da divisão da soma de cada elemento da nossa lista criada por 11;
            if ($parametroPrimeiroDigito < 2) { //caso o resto dessa divisão for menor que 2
                if ($this->cpf[9] == 0) { //o resultado deverá ser  zero, senão, o primeiro digito verificador não será válido; 
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->cpf[9] == 11 - $parametroPrimeiroDigito) { //caso o resto dessa divisão seja maior que 2, o primeiro dígito
                    return true; //após o traço deverá ser a diferença de 11 e esse resto, ou então não será válido;
                } else {
                    return false;
                }
            }
        }

        public function segundodigitoehValido() //função que será chamada para validar o segundo dígito após o traço;
        { // os mesmos procedimentos tomados para verificar o primeiro dígito são repetidos aqui, só que com algumas ressalvas:
            $newaSomar = []; 
            $a = 9; //iremos considerar o primeiro digito após o traço, também;
            for ($contador = 2; $contador <= 11; $contador++) {  //sendo assim, nosso contador vai de 2 a 11 para multiplicar
                $newaSomar[] = $contador * $this->cpf[$a]; //o primeiro dígito após o traço;
                $a--;
            }
            $parametroSegundoDigito = array_sum($newaSomar) % 11; 
            if ($parametroSegundoDigito < 2) { 
                if ($this->cpf[10] == 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->cpf[10] == 11 - $parametroSegundoDigito) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }