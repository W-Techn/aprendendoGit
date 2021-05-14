<?php
//aqui será feita a conexão entre o client-side e o server-side;
session_start();

include 'autenticacao.php';
require_once 'src/CNPJ.php';
require_once 'src/CPF.php';

$numero = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_NUMBER_FLOAT); //o conteúdo de cada lacuna preenchida deverá ser armazenada em uma variável. Para isso, deverá ser usada a função filter_input, que recebe como parâmetro:
$list = str_split($numero); //transformará a variável cpf em uma lista 

$postfields = array('cpf' => $numero);

switch (sizeof($list)) {
    case 11:

    $cpfAtestar = new CPF($list); //após todas esseas transformações, vamos passar essa nova lista como parâmetro na construção de um objeto

    if ($cpfAtestar->segundodigitoehValido() == true) {
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "http://172.22.11.31/w-api/semparar/dadosDevedor",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"cpf\"\r\n\r\n$numero\r\n-----011000010111000001101001--\r\n",
        CURLOPT_HTTPHEADER => [
            "Content-Type: multipart/form-data; boundary=---011000010111000001101001"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if (strlen($response) > 169) {
            sleep(3.5);
            $encode = explode(",", $response, 7);
            $name = $encode[5];
            $proper = explode('"', $name);
            unset($proper['"']);
            $str = $proper[3];
            $nombre = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
            
            $_SESSION['msg2'] = "<p style='color:#1aff00; font-size:1.1rem;'>É um prazer te receber $nombre!</p>
            <button>Gerar boleto</button>";
            header("Location: user.php");
            } else {
            sleep(5);
            $_SESSION['msg'] = "*CPF não encontrado";
            header("Location: index.php");
            
        }
        
        }  else { //se a o segundo dígito não passar na verificação,
            $_SESSION['msg'] = "*Esse CPF não existe!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
            header("Location: index.php"); //para a página Index;
        }
        break;
        case 14:
    
            $cnpjAtestar = new CNPJ($list); //após todas esseas transformações, vamos passar essa nova lista como parâmetro na construção de um objeto
            if ($cnpjAtestar->segundoDigitoCNPJehValido() == true) {
                $curl = curl_init();

                curl_setopt_array($curl, [
                CURLOPT_URL => "http://172.22.11.31/w-api/semparar/dadosDevedor?cpf=11000248836",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"cpf\"\r\n\r\n$numero\r\n-----011000010111000001101001--\r\n",
                CURLOPT_HTTPHEADER => [
                    "Content-Type: multipart/form-data; boundary=---011000010111000001101001"
                ],
                ]);
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
        
                curl_close($curl);
                if (strlen($response) > 169) {
                    sleep(3.5);
                    $encode = explode(",", $response, 7);
                    $name = $encode[5];
                    $proper = explode('"', $name);
                    unset($proper['"']);
                    $str = $proper[3];
                    $nombre = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
                    $_SESSION['msg2'] = "<p style='color:#1aff00; font-size:1.1rem;'>É um prazer te receber $nombre!</p>
                    <button>Gerar boleto</button>";
                    header("Location: user.php");
                    
                } else {
                    sleep(5);
                    $_SESSION['msg'] = "*CNPJ não encontrado";
                    header("Location: index.php");
                }
                }  else { //se a o segundo dígito não passar na verificação,
                    $_SESSION['msg'] = "*Esse CNPJ não existe!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
                    header("Location: index.php"); //para a página Index;
                }                
        break;
        default:
        $_SESSION['msg'] = "*Valor inválido!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
        header("Location: index.php"); //para a página Index;
}
        
    

  
