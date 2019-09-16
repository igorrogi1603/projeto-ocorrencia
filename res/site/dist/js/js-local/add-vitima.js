$(function () {

    var scntDiv = $('#dynamicDiv');

    $(document).on('click', '#addInput', function () {
        
    	var cont;
    	var proximoNum;

    	for (cont = 1; cont <=100; cont++) {
  			if (document.getElementById('div-vitima-'+cont) == null){
  			  	//caso caia aqui a div ainda nao existe
  			  	//entao essa sera a proxima div
  			  	//alert('nao achei');
  			  	//alert('div-vitima'+cont);
  				proximoNum = cont;
  			  	break;
  			}
  		}

        $(
        	
        	'<div class="box box-primary" id="excluir-box-da-vitima">'+
            '<div class="box-header with-border" id="div-vitima-'+proximoNum+'">'+
              '<h3 class="box-title">Dados da Vítima '+proximoNum+'</h3>'+
              '<div class="box-tools pull-right">'+
                '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>'+
                '<a class="btn btn-box-tool" href="javascript:void(0)" id="remInput" onBlur="qtdFamilia()">'+
        					'<i class="fa fa-close"></i>'+
        				'</a>'+
              '</div>'+
            '</div>'+
            '<div class="box-body">'+
              '<div class="row">'+
                '<div class="col-md-8">'+
                  '<div class="form-group">'+
                    '<label for="id-nome-vitima">Nome Completo da Vítima *</label>'+
                    '<input type="text" name="nomeVitima'+proximoNum+'" id="id-nome-vitima-'+proximoNum+'" class="form-control" placeholder="Digite o nome aqui" maxlength="70" onkeyup="validarCaracter(this, 1)" required>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
	              '<div class="form-group">'+
	                '<label for="id-qual-familia-vitima">Qual família?</label>'+
	                '<select class="form-control select2" name="qualFamiliaVitima'+proximoNum+'" id="id-qual-familia-vitima-'+proximoNum+'">'+
                  '</select>'+
	              '</div>'+
	            '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-sexo-vitima">Sexo</label>'+
                    '<select class="form-control select2" name="sexoVitima'+proximoNum+'" id="id-sexo-vitima">'+
                      '<option value="masculino">Masculino</option>'+
                      '<option value="feminino">Feminino</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-cpf-vitima">CPF</label>'+
                    '<input type="text" name="cpfVitima'+proximoNum+'" id="id-cpf-vitima-'+proximoNum+'" class="form-control" placeholder="___.___.___-__">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-celular-vitima">Celular</label>'+
                    '<input type="text" name="celularVitima'+proximoNum+'" id="id-celular-vitima-'+proximoNum+'" class="form-control" placeholder="_____-____">'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div id="div-responsavel-vitima-sim"></div>'+
              '<div class="row" id="div-responsavel-vitima-nao">'+
                '<div class="col-md-6">'+
                  '<div class="form-group">'+
                    '<label for="id-responsavel-vitima">Nome Completo do Responsavel da Vítima</label>'+
                    '<input type="text" name="responsavelVitima'+proximoNum+'" id="id-responsavel-vitima" class="form-control" placeholder="Digite o nome do responsavel da vitima" maxlength="70" onkeyup="validarCaracter(this, 1)">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-cpf-responsavel-vitima">CPF</label>'+
                    '<input type="text" name="cpfResponsavelVitima'+proximoNum+'" id="id-cpf-responsavel-vitima-'+proximoNum+'" class="form-control" placeholder="___.___.___-__">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-celular-responsavel-vitima">Celular</label>'+
                    '<input type="text" name="celularResponsavelVitima'+proximoNum+'" id="id-celular-responsavel-vitima-'+proximoNum+'" class="form-control" placeholder="_____-____">'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-12">'+
                  '<h4>Endereço da Vítima</h4>'+
                  '<hr>'+
                '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-2">'+
                  '<div class="form-group">'+
                    '<label for="id-cep-usuario">CEP</label>'+
                    '<input type="text" name="cepVitima'+proximoNum+'" id="id-cep-vitima-'+proximoNum+'" class="form-control" placeholder="_____-___" onclick="getCalculaCepApuracao()">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-5">'+
                  '<div class="form-group">'+
                    '<label for="id-rua-vitima">Rua</label>'+
                    '<input type="text" name="ruaVitima'+proximoNum+'" id="id-rua-vitima-'+proximoNum+'" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-5">'+
                  '<div class="form-group">'+
                    '<label for="id-bairro-vitima">Bairro</label>'+
                    '<input type="text" name="bairroVitima'+proximoNum+'" id="id-bairro-vitima-'+proximoNum+'" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100" onkeyup="validarCaracter(this, 3)">'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-2">'+
                  '<div class="form-group">'+
                    '<label for="id-numero-vitima">Numero</label>'+
                    '<input type="number" name="numeroVitima'+proximoNum+'" id="id-numero-vitima" class="form-control" placeholder="Numero da casa" min="0">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-estado-vitima">Estado</label>'+
                    '<select class="form-control select2" name="estadoVitima'+proximoNum+'" id="id-estado-vitima-'+proximoNum+'">'+
                      '<option value="ac">Acre</option>'+
                      '<option value="al">Alagoas</option>'+
                      '<option value="ap">Amapá</option>'+
                      '<option value="am">Amazonas</option>'+
                      '<option value="ba">Bahia</option>'+
                      '<option value="ce">Ceará</option>'+
                      '<option value="df">Distrito Federal</option>'+
                      '<option value="es">Espirito Santos</option>'+
                      '<option value="go">Goiás</option>'+
                      '<option value="ma">Maranhão</option>'+
                      '<option value="mt">Mato Grosso</option>'+
                      '<option value="ms">Mato Grosso do Sul</option>'+
                      '<option value="mg">Minas Gerais</option>'+
                      '<option value="pa">Pará</option>'+
                      '<option value="pb">Paraíba</option>'+
                      '<option value="pr">Paraná</option>'+
                      '<option value="pe">Pernambuco</option>'+
                      '<option value="pi">Piauí</option>'+
                      '<option value="rj">Rio de Janeiro</option>'+
                      '<option value="rn">Rio Grande do Norte</option>'+
                      '<option value="rs">Rio Grande do Sul</option>'+
                      '<option value="ro">Rondônia</option>'+
                      '<option value="rr">Roraima</option>'+
                      '<option value="sc">Santa Catarina</option>'+
                      '<option value="sp" selected>São Paulo</option>'+
                      '<option value="se">Sergipe</option>'+
                      '<option value="to">Tocantins</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-cidade-vitima">Cidade</label>'+
                    '<input type="text" name="cidadeVitima'+proximoNum+'" id="id-cidade-vitima-'+proximoNum+'" class="form-control" value="Nova Campina" onkeyup="validarCaracter(this, 1)">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-complemento-vitima">Complemento</label>'+
                    '<input type="text" name="complementoVitima'+proximoNum+'" id="id-complemento-vitima" class="form-control" placeholder="Complemento" maxlength="100" onkeyup="validarCaracter(this, 3)">'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'
          

        ).appendTo(scntDiv);
        return false;
    });

    $(document).on('click', '#remInput', function () {
        $(this).parents('#excluir-box-da-vitima').remove();
        return false;
    });
});

/*'<a class="btn btn-danger" href="javascript:void(0)" id="remInput">'+
	'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
	'Remover Campo'+
'</a>'+*/