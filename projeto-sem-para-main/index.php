<?php
session_start();
?>
<!DOCTYPE html> <!-- página em que o usuário fará login -->
<html lang="en"> 
<head>
  <meta charset="utf-8"> <!-- encoding -->
  <title>Negócios Sem Parar</title> <!-- nome da página -->
  <!-- Imports -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="css/inicio.css">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> 
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <!-- IMPORTANTE! -->
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body> 
  <div id="container"> 
    <div class="row">        
    </div> <!-- Disponibilização dos ele- -->
    <div class="row"> <!-- mentos e respon- -->
      <div class="col-md-12"> <!-- sividade -->
        <div class="pr-wrap">
        </div>
        <div class="wrap">
          <form class="login" action="verificador.php" method="post" id="formulario"> <!-- incialização e estilização do formuário (classe Login) -->
            <img id="logo" src="logo-sem-parar.png"/>
            <p class="form-title">
            sign in</p> <!-- título com cor da eSem Parar -->
            <input type="text" placeholder="CPF ou CNPJ"  id="CPF" name="chave" required /> <!-- CPF com máscara que alterna para CNPJ ao atingir a quantidade de 12 dígtos -->
            <div>
              <p style='color:darkred; font-size:.8rem;'>
                <?php
                        if(isset($_SESSION['msg'])) { //aqui ira inserir/retirar as mensagens de confirmação do CPF;
                          echo $_SESSION['msg'];
                          unset($_SESSION['msg']);
                        }
                        ?>
                      </p>
                    </div>
                    <input type="submit" value="Verificar" class="btn btn-danger btn-sm" />
                    <div class="remember-forgot">
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <a type="button" role="button" class="fixed-bottom btn btn-success btn-circle btn-xl" href="https://api.whatsapp.com/send/?phone=5511975141378&text=Ola&app_absent=0"><img id="zapzap" src="css/whatsapp-icon.webp"></a> <!-- botão do Whatsapp que redireciona para o atendimento do Sem Parar -->
                </div>
                <div>
                  <a _ngcontent-opv-c1="" class="fixed-bottom auto_inicio" id="link" href="http://www.fulltimesolucoes.com.br/" target="_blank">A Fulltime é uma empresa autorizada pelo Sem Parar para a cobrança de débito.</a> <!-- link borda da página que direciona para a Full Time -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="js/jquery.mask.min.js"></script>
      <script> 
        // Formatador da máscara do input
        $(document).ready(function(){ 
          // ao documento ser carregado para leitura, fazer:
          var SPMaskBehavior = function (val) { //uma variável que será uma função que fará
            return val.replace(/\D/g, '').length === 14 ? '00.000.000/0000–00' : '000.000.000–00999';
          }, //o retorno do valor inputado pelo usuário formatado de acordo com a quantidade: se for 14 digitos, uma máscara,se for menos, outra máscara. Os números 9 após a mascara de CPF, possibilitam que o usuário digite os numeros a mais indicando CNPJ
          spOptions = { //essa variável 
            onKeyPress: function(val, e, field, options) { //serve 
              field.mask(SPMaskBehavior.apply({}, arguments), options); //para criar as 
            } //opções que serão inseridas
          }; //no campo do CPF  
          $('#CPF').mask(SPMaskBehavior, spOptions); //o campo de #CPF 
        }); //será então uma alternância
//entre os valores formatados de acordo 
//com a quantidade de caracteres
      </script>
    </body>
    </html>
