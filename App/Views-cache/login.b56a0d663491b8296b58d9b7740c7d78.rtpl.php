<?php if(!class_exists('Rain\Tpl')){exit;}?><!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/res/site/dist/css/bootstrap4/bootstrap.min.css">

    <link rel="stylesheet" href="/res/site/dist/css/css-login.css">

    <title>SOM | Login</title>
  </head>
  <body>
    
    <div class="container-fluid esticado">
      <div class="row esticado">
        <div class="col-md-8 bg-image d-flex align-items-center">
          <div class="bg-branco mx-auto d-block d-flex align-items-center fundo-img">
            <img class="mx-auto" src="/res/site/dist/img/logo-azul.png" width="70">
          </div>
        </div>
        
        <div class="col-md-4 esticado bg-branco p-5">
          <h1 class="mb-5 text-cor">Entrar</h1>

          <form action="/login" method="post">
            <div class="form-group">
                <label class="text-normal text-dark">Usuário</label>
                <input type="text" name="usernameUsuario" class="form-control" placeholder="Usuário">
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Senha</label>
                <input type="password" name="senhaUsuario" class="form-control" placeholder="Senha">
            </div>

            <div class="row">
              <div class="col-md-12">
                <?php if( $error != '' ){ ?>
                <div class="alert alert-danger">
                  <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
              </div>
            </div>

            <p class="text-right esqueci"><a href="#">Esqueci a senha</a></p>
            <button class="btn btn-block btn-cor arredondamento">Logar</button>
          </form>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/res/site/dist/js/bootstrap4/jquery-3.3.1.slim.min.js"></script>
    <script src="/res/site/dist/js/bootstrap4/popper.min.js"></script>
    <script src="/res/site/dist/js/bootstrap4/bootstrap.min.js"></script>
  </body>
</html>