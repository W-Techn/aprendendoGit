<?php
//Importando a classe
require_once 'src/CPF.php';

echo "-----------------------------Teste 1---------------------" . PHP_EOL;

//Ambos dígitos verificadores verdadeiros
$cpf = '29946762064';
$cpf2 = str_split($cpf);
$teste = new CPF($cpf2);

var_dump($teste->primeirodigitoehValido());
var_dump($teste->segundodigitoehValido());

echo "-----------------------------Teste 2---------------------" . PHP_EOL;

//apenas com o segundo dígito verificador falso
$teste2 = new CPF([5, 8, 8, 2, 9, 4, 1, 8, 0, 6, 5]);
var_dump($teste2->primeirodigitoehValido());
var_dump($teste2->segundodigitoehValido());

echo "-----------------------------Teste 3---------------------" . PHP_EOL;

//apenas com o primeiro dígito verificador falso
$teste3 = new CPF([1, 7, 5, 4, 5, 7, 4, 6, 0, 7, 3]);
var_dump($teste3->primeirodigitoehValido());
var_dump($teste3->segundodigitoehValido());
//o segundo digito verificador também se tornou inválido
//só precisamos verificar, então, se o segundo digito verificador é válido

