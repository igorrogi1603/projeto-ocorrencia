<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Usuário Detalhe</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Usuário Detalhe</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!--Box Detalhes-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Detalhes</h3>

        <!--<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>-->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!--Inicio Row-->
        <div class="row">
          <!--Detalhes-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Nome: </strong><?php echo htmlspecialchars( $detalheUsuario["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $detalheUsuario["isPessoa"] == 0 ){ ?>
            <p class="sem-espacamento"><strong>CNPJ: </strong><?php echo htmlspecialchars( $detalheUsuario["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Instituição</strong></p>
            <?php } ?>
            <?php if( $detalheUsuario["isPessoa"] == 1 ){ ?>
            <p class="sem-espacamento"><strong>Pessoa Física</strong></p>
            <p class="sem-espacamento"><strong>Data de Nascimento: </strong><?php echo htmlspecialchars( $detalheUsuario["dataNasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Idade: </strong><?php echo htmlspecialchars( $detalheUsuario["qtdAnos"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>CPF: </strong><?php echo htmlspecialchars( $detalheUsuario["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>RG: </strong><?php echo htmlspecialchars( $detalheUsuario["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Sexo: </strong><?php echo htmlspecialchars( $detalheUsuario["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php } ?>
          </div>
          <!--Fim Detalhes-->

          <!--Vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>Usuario: </strong><?php echo htmlspecialchars( $detalheUsuario["user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Nivel de Acesso: </strong><?php echo htmlspecialchars( $detalheUsuario["nivelAcesso"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $detalheUsuario["isPessoa"] == 1 ){ ?>
            <p class="sem-espacamento"><strong>Função: </strong><?php echo htmlspecialchars( $detalheUsuario["funcao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Setor: </strong><?php echo htmlspecialchars( $detalheUsuario["setor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php } ?>
            <p class="sem-espacamento"><strong>Celular: </strong><?php echo htmlspecialchars( $detalheUsuario["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Telefone Fixo: </strong><?php echo htmlspecialchars( $detalheUsuario["fixo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>E-mail: </strong><?php echo htmlspecialchars( $detalheUsuario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Vitima-->

          <!--Endereco da vitima-->
          <div class="col-md-4">
            <p class="sem-espacamento"><strong>CEP: </strong><?php echo htmlspecialchars( $detalheUsuario["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Rua: </strong><?php echo htmlspecialchars( $detalheUsuario["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Número: </strong><?php echo htmlspecialchars( $detalheUsuario["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Bairro: </strong><?php echo htmlspecialchars( $detalheUsuario["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Cidade: </strong><?php echo htmlspecialchars( $detalheUsuario["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Estado: </strong><?php echo htmlspecialchars( $detalheUsuario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="sem-espacamento"><strong>Complemento: </strong><?php echo htmlspecialchars( $detalheUsuario["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <!--Fim Endereco da vitima-->
        </div>
        <!--Fim Row-->
          
        <br>
        <hr>
        <br>

        <div class="alert" style="background-color: #FFF3CD; color: #A18532;" role="alert">
          Um usuário bloqueado <strong>não</strong> poderá acessar o sistema até que seja desbloqueado.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            <h4>Status</h4>
            <?php if( $detalheUsuario["isBloqueado"] == 0 ){ ?>
            <p class="sem-espacamento"><strong>Desbloqueado</strong></p>
            <?php }else{ ?>
            <p class="sem-espacamento"><strong>Bloqueado</strong></p>
            <?php } ?>
          </div>
        </div>
        <!--Fim Row-->

        <br>
        <hr>
        <br>

        <!--Inicio Row-->
        <div class="row">
          <div class="col-md-12">
            
            <a href="/usuarios-detalhe/editar/<?php echo htmlspecialchars( $detalheUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-edit"></i>Editar</a>

            <?php if( $detalheUsuario["isBloqueado"] == 0 ){ ?>
            <a class="btn btn-app" onclick="confirmarBloquear()"><i class="fa fa-ban"></i>Bloquear</a>
            <?php }else{ ?>
            <a class="btn btn-app" onclick="confirmarDesbloquear()"><i class="fa fa-check"></i>Desbloquear</a>
            <?php } ?>      

            <a href="/usuarios-alterar-senha/senha/<?php echo htmlspecialchars( $detalheUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-app"><i class="fa fa-lock"></i>Alterar Senha</a>

            <a href="/usuarios-lista" class="btn btn-app"><i class="fa fa-arrow-left"></i>Voltar</a>

          </div>
        </div>
        <!--Fim Row-->
      </div>
      <!-- /.box-body -->
    </div>
    <!--Fim Box Detalhes-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

function confirmarBloquear()
{
  if(confirm("Voce realmente deseja BLOQUEAR esse usuário ")){
    location.href="/usuarios-detalhe/bloquear/<?php echo htmlspecialchars( $detalheUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

function confirmarDesbloquear()
{
  if(confirm("Voce realmente deseja DESBLOQUEAR esse usuário ")){
    location.href="/usuarios-detalhe/desbloquear/<?php echo htmlspecialchars( $detalheUsuario["idUsuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>";
  }
}

</script>