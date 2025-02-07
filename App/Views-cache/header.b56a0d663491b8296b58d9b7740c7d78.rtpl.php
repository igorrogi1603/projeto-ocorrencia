<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SOM | Sistema de Ocorrência Municipal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/res/site/bootstrap/css/bootstrap.min.css">
  <!--Css Local-->
  <link rel="stylesheet" type="text/css" href="/res/site/dist/css/local-css.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/site/dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/res/site/plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/res/site/dist/css/skins/_all-skins.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="/res/site/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/res/site/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/res/site/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="/res/site/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="/res/site/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/res/site/plugins/select2/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/res/site/plugins/iCheck/flat/blue.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/res/site/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SOM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SOM</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <?php $conselho = 0; ?>
          <?php $outro = 0; ?>

          <?php $counter1=-1;  if( isset($notificacao) && ( is_array($notificacao) || $notificacao instanceof Traversable ) && sizeof($notificacao) ) foreach( $notificacao as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1["idUsuario"] == null ){ ?>
              <?php $conselho += 1; ?>
            <?php } ?>
            
            <?php if( $value1["idUsuario"] != null ){ ?>
            <?php if( $nivelAcesso == 2 OR $nivelAcesso == 3748 ){ ?>
            <?php if( $value1["idUsuario"] == $idUser ){ ?>
              <?php $outro += 1; ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>

          <?php } ?>

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210 ){ ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo htmlspecialchars( $conselho, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </a>
            <?php } ?>

            <?php if( $nivelAcesso == 2 OR $nivelAcesso == 3748 ){ ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo htmlspecialchars( $outro, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </a>
            <?php } ?>

            <ul class="dropdown-menu">

              <?php if( $nivelAcesso == 4  OR $nivelAcesso == 2210 ){ ?>
              <li class="header">Você tem <?php echo htmlspecialchars( $conselho, ENT_COMPAT, 'UTF-8', FALSE ); ?> notificação(s)</li>
              <?php } ?>

              <?php if( $nivelAcesso == 2 OR $nivelAcesso == 3748 ){ ?>
              <li class="header">Você tem <?php echo htmlspecialchars( $outro, ENT_COMPAT, 'UTF-8', FALSE ); ?> notificação(s)</li>
              <?php } ?>

              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <?php $counter1=-1;  if( isset($notificacao) && ( is_array($notificacao) || $notificacao instanceof Traversable ) && sizeof($notificacao) ) foreach( $notificacao as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1["idUsuario"] == null ){ ?>
                  <?php if( $nivelAcesso == 4  OR $nivelAcesso == 2210 ){ ?>
                  <li><!-- start notification -->
                    <a href="/excluir-notificacao/<?php echo htmlspecialchars( $value1["idNotificacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <small><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars( $value1["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small> 
                      <br><strong><?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
                    </a>
                  </li><!-- end notification -->
                  <?php } ?>
                  <?php } ?>

                  <?php if( $value1["idUsuario"] != null ){ ?>
                  <?php if( $nivelAcesso == 2 OR $nivelAcesso == 3748 ){ ?>
                  <?php if( $value1["idUsuario"] == $idUser ){ ?>
                  <li><!-- start notification -->
                    <a href="/excluir-notificacao/<?php echo htmlspecialchars( $value1["idNotificacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <small><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars( $value1["dataRegistro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small> 
                      <br><strong><?php echo htmlspecialchars( $value1["tipo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
                    </a>
                  </li><!-- end notification -->
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>

                  <?php } ?>
                </ul>
              </li>
            </ul>
          </li>
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <a href="/logout" style="display: block;"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/res/site/dist/img/logo-azul.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo htmlspecialchars( $user, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!--Inicio-->
        <li><a href="/"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

        <!--Criar averiguacao-->
        <li><a href="#"><i class="fa fa-file-o"></i> <span>Criar Averiguação</span></a></li>

        <!--Criar Apuracao-->
        <li><a href="/criar-apuracao"><i class="fa fa-file"></i> <span>Criar Apuração</span></a></li>

        <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210 OR $nivelAcesso == 3748 ){ ?>
        <!--Averiguacao-->
        <li><a href="#"><i class="fa fa-file-text-o"></i> <span>Averiguação</span></a></li>

        <!--Apuracao-->
        <li class="treeview">
          <a href="#"><i class="fa fa-file-text"></i> <span>Apurações</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lista-apuracoes">Abertas</a></li>
            <li><a href="/confirmar-apuracao">Confirmações</a></li>
            <li><a href="/apuracao-excluida">Excluidas</a></li>
          </ul>
        </li>
        <!--Fim Criar Apuracao-->
        <?php } ?>

        <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210 OR $nivelAcesso == 3748 ){ ?>
        <!--Inicio Ocorrencia-->
        <li class="treeview">
          <a href="#"><i class="fa fa-th-large"></i> <span>Ocorrências</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/ocorrencias-abertas">Abertas</a></li>
            <li><a href="/ocorrencias-reabertas">Reabertas</a></li>
            <li><a href="/ocorrencias-arquivadas">Arquivadas</a></li>
            <li><a href="/ocorrencias-encerradas">Encerradas</a></li>
          </ul>
        </li>
        <!--Fim Ocorrencia-->
        <?php } ?>
        
        <?php if( $nivelAcesso == 2 OR $nivelAcesso == 2210 OR $nivelAcesso == 3748 ){ ?>
        <!--Solicitacoes-->
        <li><a href="/solicitacoes"><i class="fa fa-envelope"></i> <span>Solicitações</span></a></li>
        <?php } ?>

        <?php if( $nivelAcesso == 3 OR $nivelAcesso == 2210 ){ ?>
        <!--Inicio Usuario-->
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Usuários</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/usuarios-cadastrar">Cadastrar</a></li>
            <li><a href="/usuarios-lista">Lista</a></li>
          </ul>
        </li>
        <!--Fim Usuario-->
        <?php } ?>

        <?php if( $nivelAcesso == 4 OR $nivelAcesso == 2210  OR $nivelAcesso == 3748 ){ ?>
        <!--Status Servidor-->
        <li><a href="/pesquisar-pessoa"><i class="fa fa-search"></i> <span>Pesquisar Pessoa</span></a></li>
        <?php } ?>

        <?php if( $nivelAcesso == 5 OR $nivelAcesso == 2210 ){ ?>

        <!--Status Servidor-->
        <li><a href="/status-servidor"><i class="fa fa-tv"></i> <span>Status Servidor</span></a></li>

        <!--Backup-->
        <li><a href="/backup"><i class="fa fa-save"></i> <span>Backup</span></a></li>
        <?php } ?>

        <!--Inicio Documentacao-->
        <li><a href="/biblioteca"><i class="fa fa-book"></i> <span>Biblioteca</span></a></li>        
        <!--Fim Documentacao-->

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!---------------------------------------------------------------------------------------------------->
  <!---------------------------------------------------------------------------------------------------->
  <!---------------------------------------------------------------------------------------------------->