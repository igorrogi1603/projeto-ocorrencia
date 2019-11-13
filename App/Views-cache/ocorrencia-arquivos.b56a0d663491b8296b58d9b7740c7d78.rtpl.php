<?php if(!class_exists('Rain\Tpl')){exit;}?><!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/res/site/dist/css/bootstrap4/bootstrap.min.css">

    <link rel="stylesheet" href="/res/site/dist/css/css-arquivo-ocorrencia.css">

    <title>SOM | Arquivos da Ocorrência</title>
  </head>
  <body>
    
    <div class="container-fluid total">
      <!--Row-->
      <div class="row" class="total">
        <!--Inicio Lateral-->
        <div class="col-md-3 total">

          <ul class="list-group list-group-flush lateral">

            <div class="row lateral-superior">
              <div class="col-md-12">
                <label><input type="checkbox" name="selecionaTudo" value="0"> Seleciona Tudo</label>
              </div>
            </div>

            <?php $counter1=-1;  if( isset($arquivos) && ( is_array($arquivos) || $arquivos instanceof Traversable ) && sizeof($arquivos) ) foreach( $arquivos as $key1 => $value1 ){ $counter1++; ?>
            <a href="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="name-iframe"><li class="list-group-item documento">
              <input type="checkbox" name="documento" value="<?php echo htmlspecialchars( $value1["idArquivo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"> <?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </li></a>
            <?php } ?>

          </ul>
        </div>
        <!--Fim Lateral-->

        <!--Inicio iframes-->
        <div class="col-md-8" class="total">
          <iframe id="id-iframe" name="name-iframe"></iframe>
        </div>
        <!--Fim iframes-->
      </div>
      <!--Fim row-->      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/res/site/dist/js/bootstrap4/jquery-3.3.1.slim.min.js"></script>
    <script src="/res/site/dist/js/bootstrap4/popper.min.js"></script>
    <script src="/res/site/dist/js/bootstrap4/bootstrap.min.js"></script>
  </body>
</html>
