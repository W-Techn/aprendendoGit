<?php
//aqui será feita a conexão entre o client-side e o server-side;
session_start();

include 'autenticacao.php';
require_once 'src/CNPJ.php';
require_once 'src/CPF.php';

$numero = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_NUMBER_FLOAT); //o conteúdo de cada lacuna preenchida deverá ser armazenada em uma variável. Para isso, deverá ser usada a função filter_input, que recebe como parâmetro:
$Formatado = str_split($numero); //transformará a variável cpf em uma lista 

$sql= "SELECT * FROM cadastros where Registros = '$numero'";

switch (sizeof($Formatado)) {
    case 12:
        unset($Formatado[9]); //retira o traço do CPF
        $numerosemtraco = array_values($Formatado); //rearranja a lista após a deleção anterior

        $cpfAtestar = new CPF($numerosemtraco); //após todas esseas transformações, vamos passar essa nova lista como parâmetro na construção de um objeto

    if ($cpfAtestar->segundodigitoehValido() == true) {

        $resultado_usuario = mysqli_query($conn, $sql);
            if (mysqli_num_rows($resultado_usuario) > 0) {
                sleep(3.5);
                $_SESSION['msg2'] = "<p style='color:#1aff00; font-size:1.1rem;'>É um prazer te receber!</p>
                <button>Gerar boleto</button>";
                header("Location: pessoafisica.php");    
            } else {
                sleep(5);
                $_SESSION['msg'] = "*CPF não encontrado";
                header("Location: index.php");
            }    
        }  else { //se a o segundo dígito não passar na verificação,
            $_SESSION['msg'] = "*Valor inválido!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
            header("Location: index.php"); //para a página Index;
        }
        break;
        case 15:
            unset($Formatado[12]); //retira o traço do CPF
            $numerosemtraco = array_values($Formatado); //rearranja a lista após a deleção anterior
    
            $cnpjAtestar = new CNPJ($numerosemtraco); //após todas esseas transformações, vamos passar essa nova lista como parâmetro na construção de um objeto
            if ($cnpjAtestar->segundoDigitoCNPJehValido() == true) {

                $resultado_usuario = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($resultado_usuario) > 0) {
                        sleep(3.5);
                        $_SESSION['msg2'] = "<p style='color:#1aff00; font-size:1.1rem;'>É um prazer te receber!</p>
                        <button>Gerar boleto</button>";
                        header("Location: pessoafisica.php");    
                    } else {
                        sleep(5);
                        $_SESSION['msg'] = "*CNPJ não encontrado";
                        header("Location: index.php");
                    }    
                }  else { //se a o segundo dígito não passar na verificação,
                    $_SESSION['msg'] = "*Valor inválido!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
                    header("Location: index.php"); //para a página Index;
                }                
        break;
        default:
        $_SESSION['msg'] = "*Valor inválido!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
        header("Location: index.php"); //para a página Index;
}
        
    

  
