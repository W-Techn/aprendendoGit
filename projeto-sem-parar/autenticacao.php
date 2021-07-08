<?php

// aqui é criado uma variável que fara a conexão com o servidor MySQl, ele deverá receber os parâmetros: 
$servidor = "localhost"; //do servidor da máquina
$usuario = "root"; //do usúario (nesse caso, usuário raíz)
$senha = ""; //a senha que foi criada no mysql
$dbname = "sem parar"; //o banco de dados em que está a tebela clientes (nesse caso,
//                          eu usei um db com nome de cadastramento)  
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname); //a função que receberá esses parâmetros e enviará na
//conexão com o MySQl é o mysqli_connect