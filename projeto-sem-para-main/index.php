<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Negócios Sem Parar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="inicio.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Fazer uma consulta</h3>
                <div class="d-flex justify-content-end social_icon">
                </div>
            </div>
            <div class="card-body">
                <form action="verificador.php" method="post" id="formulario">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" class="form-control" id="CPF" name="chave" data-js="Cpf" placeholder="digite seu CPF ou CNPJ" required>
                    </div>
                    <div  class="d-inline">
                        <p style='color:#ffffff; font-size:1rem;' class="d-inline">
                        <?php
                        if(isset($_SESSION['msg'])) { //aqui ira inserir/retirar as mensagens de confirmação do CPF;
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                        </p>
                    </div>
                    <div class="form-group d-inline">
                        <button class="btn float-right login_btn"> VERIFICAR </button>
                    </div>
                    <button class="btn btn-primary d-none" id="carregando" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Consultando...
                    </button> 
                  </form> 
            </div>
            <div class="d-flex justify-content-center">
                <a class="fixed-bottom auto_inicio links" href="https://www.fulltimesolucoes.com.br/">A Fulltime é uma empresa autorizada pelo Sem Parar para a cobrança de débito</a>
            </div>
        </div>
    </div>
</div>
<script src="js/loading.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script> 
$(document).ready(function(){

    var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 14 ? '00.000.000/0000-00' : '000.000.000-00999';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};  
  $('#CPF').mask(SPMaskBehavior, spOptions);
});


</script>
<!-- <script src="js/inputcampo.js"></script> -->
</body>
</html>

