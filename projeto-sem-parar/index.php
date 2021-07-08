<?php
session_start(); /*Sessão iniciada*/
?> <!-- e nessa página será imprimido os dados do cliente cadastrado -->
<?php
$usuario = $_SESSION['msg2']; //vamos armazenar uma variável a mensagem trazida da página de verificação
// url do sistema login
$urlHome = $_SERVER["HTTP_HOST"];
$cookie_name = "usuário"; 
$cookie_value = $usuario;
setcookie($cookie_name, $cookie_value, time() + (55)); //criamos um cookie para a sessão com o nome, o usuário e um tempo de validade
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home - Usuário</title> <!-- nome da página -->
  <!-- imports -->
  <link rel="stylesheet" type="text/css" href="css/user.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="box register">
        <?php
        if (!isset($_COOKIE[$cookie_name])) { //verificação se o cookie está inativo
            // echo '<div>
            // <h5 style="color: white;">A sessão expirou<h5>
            // </div>
            // ';
            // echo '<div style="margin-top: 15px;">
            // <a class="btn btn-primary" href="http://'.$urlHome . '/projeto-sem-parar/login.php" role="button">Home</a>            </div>';
            sleep(2.3);
            header("Location: login.php");
            die(); // caso sim, imprime um erro na tela ao invés do conteúdo principal
        }
        ?>
        <!-- inicia o conteúdo principal -->
        <div class="row"> 
            <div class="col-md-3 register-left"> <!-- conteúdo da esquerda -->
                <img src="css/sem-parar-logo2.png" alt="logo Sem Parar animado" />
                <h3><?php
                        if(isset($cookie_value)) { //aqui ira inserir/retirar as mensagens de confirmação do CPF;
                            echo $cookie_value;
                            unset($cookie_value);
                        }
                        ?></h3>

                    </div>
                    <!-- conteúdo da direita -->
                    <div class="col-md-9 register-right"> 
                        <!-- navbar com os conteúdos a serem exibidos (usuário acessado por padrão) -->
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <!-- alinhamento -->
                            <li class="nav-item">
                                <!-- item padrão selecionado da navbar -->
                                <a class="nav-link active" id="login-tab" data-toggle="tab" role="tab" aria-controls="login" aria-selected="true">Usuário</a>
                            </li>
                            <!-- tab opção de outra consulta --> 
                            <li class="nav-item">
                                <a class="nav-link" id="newuser-tab" data-toggle="tab" href="http://<?php echo $urlHome; ?>/projeto-sem-parar/login.php" role="tab" aria-controls="newuser" aria-selected="false">Outra consulta</a>
                            </li>
                        </ul>
                        <!-- conteúdo abaixo da navtab -->
                        <div class="tab-content" id="myTabContent"> 
                            <!-- Quadro com o conteúdo escrito -->
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <h3 class="register-heading">Bem-vindo!</h3>
                                <div class="row register-form">
                                    <div class="col-md-12 profile_card">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="form-group">
                                               <i class="fa fa-lock"></i>
                                               <h6 style="color: white;">Clique no botão abaixo para gerar o boleto referente a cobrança</h6>
                                           </div>
                                       </form>
                                       <div>
                                        <!-- botão que irá gerar o boleto com as especificações -->
                                          <input type="submit" class="btn btn-primary botao" value="Gerar boleto" />
                                      </div>
                                  </div>
                              </div>
                          </div>
            <!-- segunda tab que alterna para o modo de nova consulta -->
                          <div class="tab-pane fade show" id="newuser" role="tabpanel" aria-labelledby="newuser-tab">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <div class="float-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>