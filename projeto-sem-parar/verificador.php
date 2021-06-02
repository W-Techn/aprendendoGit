<?php
//aqui será feita a conexão entre o client-side e o server-side;
session_start();

include 'autenticacao.php'; //import das configurações do servidor a ser conectado

$numero = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_NUMBER_FLOAT); //o conteúdo de cada lacuna preenchida deverá ser armazenada em uma variável. Para isso, deverá ser usada a função filter_input, que recebe como parâmetro:
$list = str_split($numero); //transformará a variável cpf em uma lista 

switch (sizeof($list)) { //laço que analiza o tamanho da lista CPF
    case 11: //caso valor seja de 11, quer dizer que se trata de uma CPF
    
        $curl = curl_init(); //inicia-
//mos a requisição
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://172.22.11.31/w-api/semparar/dadosDevedor", //definimos a URL
            CURLOPT_RETURNTRANSFER => true, //retornamos o valor de curl_exec()
            CURLOPT_ENCODING => "", //a informação da api em metadados
            CURLOPT_MAXREDIRS => 10, //número de direcionamentos
            CURLOPT_TIMEOUT => 30, //tempo até expiramento da seçãp
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, //versão Http
            CURLOPT_CUSTOMREQUEST => "POST", //méto de requisição
            CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"cpf\"\r\n\r\n$numero\r\n-----011000010111000001101001--\r\n", //linhas que serão enviadas ao client-side pelo método POST
            CURLOPT_HTTPHEADER => [
                "Content-Type: multipart/form-data; boundary=---011000010111000001101001" //transforma os 
            ], //dados recolhidos em um array
        ]);

        $response = curl_exec($curl); //executa a conexão e passa todos os padrões acima declarados
        $err = curl_error($curl); //armazena um 
//erro caso ocorra
        curl_close($curl); //fecha a conexão
        
        $rt = json_decode($response); //aqui 

        if ($rt->data->cliente == 'null') { 
            sleep(5);
            $_SESSION['msg'] = "*CPF não encontrado"; //significa que ele não encontrou nada, então
            header("Location: index.php"); //exibi-
    //remos uma mensagem de erro na pagina Inicial
        } else {
            sleep(3.5); //efeito de carregamento onde se encontra o usuário
            $rt = json_decode($response); //aqui 
//vamos armazenar a resposta em um formato JSON
            $name = mb_convert_case($rt->data->cliente[0]->Nome, MB_CASE_TITLE, "UTF-8"); //o nome se encontra no objeto do primeiro item do array Nome, que por sua vez é um objeto de data. Ele está inteiro mem letra maiúscula, portanto vamos colocá-lo de maneira normal
            $_SESSION['msg2'] = "$name"; //enviaremos então essa variável para ser mostrada
            header("Location: user.php"); //na página do usuário
           
        }
        
        break;
        case 14: //caso valor seja de 11, quer 
    //dizer que se trata de uma CPF
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

                $rt = json_decode($response);
                if ($rt->data->cliente == 'null') {
                    sleep(5);
                    $_SESSION['msg'] = "*CNPJ não encontrado";
                    header("Location: index.php");
                    
                } else {
                    sleep(3.5);
                    $name = mb_convert_case($rt->data->cliente[0]->Nome, MB_CASE_TITLE, "UTF-8");
                    $_SESSION['msg2'] = "$name";
                    header("Location: user.php");
                }            
                break;
                default:
        $_SESSION['msg'] = "*Valor inválido!"; //significa que ele não existe, e é isso que nós passaremos a imprimir na nova seção que será aberta, no redirecionamento que haverá
        header("Location: index.php"); //para a página Index;
    }

    


