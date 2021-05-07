<?php
include 'autenticacao.php';
include 'CPFconn.php';


$sql= "SELECT * FROM cadastros where cpf = '$cpf'";

$result = mysqli_query($conn, $sql);

sleep(15);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo json_encode($row);
    }
  } else {
      $nsg=["nsg"=> "erro 0 linhas"];
    echo json_encode($nsg);
  }
$var = [
    "nome"=> "marconi",
    "cpf" => "22222222222"
];



// echo json_encode($rt);

?>