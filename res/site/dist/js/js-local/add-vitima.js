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
              '<h3 class="box-title">Dados da Vítima</h3>'+
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
                    '<input type="text" name="nome-vitima-'+proximoNum+'" id="id-nome-vitima" class="form-control" placeholder="Digite o nome aqui" maxlength="70" required>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
	              '<div class="form-group">'+
	                '<label for="id-qual-familia-vitima">Qual família?</label>'+
	                '<select class="form-control select2" name="qual-familia-vitima-'+proximoNum+'" id="id-qual-familia-vitima-'+proximoNum+'">'+
                  '</select>'+
	              '</div>'+
	            '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-sexo-vitima">Sexo</label>'+
                    '<select class="form-control select2" name="sexo-vitima-'+proximoNum+'" id="id-sexo-vitima">'+
                      '<option value="masculino">Masculino</option>'+
                      '<option value="feminino">Feminino</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-cpf-vitima">CPF</label>'+
                    '<input type="text" name="cpf-vitima-'+proximoNum+'" id="id-cpf-vitima" class="form-control" placeholder="___.___.___-__">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-celular-vitima">Celular</label>'+
                    '<input type="text" name="celular-vitima-'+proximoNum+'" id="id-celular-vitima" class="form-control" placeholder="_____-____">'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div id="div-responsavel-vitima-sim"></div>'+
              '<div class="row" id="div-responsavel-vitima-nao">'+
                '<div class="col-md-6">'+
                  '<div class="form-group">'+
                    '<label for="id-responsavel-vitima">Nome Completo do Responsavel da Vítima</label>'+
                    '<input type="text" name="responsavel-vitima-'+proximoNum+'" id="id-responsavel-vitima" class="form-control" placeholder="Digite o nome do responsavel da vitima" maxlength="70">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-cpf-responsavel-vitima">CPF</label>'+
                    '<input type="text" name="cpf-responsavel-vitima-'+proximoNum+'" id="id-cpf-responsavel-vitima" class="form-control" placeholder="___.___.___-__">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<div class="form-group">'+
                    '<label for="id-celular-responsavel-vitima">Celular</label>'+
                    '<input type="text" name="celular-responsavel-vitima-'+proximoNum+'" id="id-celular-responsavel-vitima" class="form-control" placeholder="_____-____">'+
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
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-rua-vitima">Rua</label>'+
                    '<input type="text" name="rua-vitima-'+proximoNum+'" id="id-rua-vitima" class="form-control" placeholder="Digite o nome da rua da vitima" maxlength="100">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-bairro-vitima">Bairro</label>'+
                    '<input type="text" name="bairro-vitima-'+proximoNum+'" id="id-bairro-vitima" class="form-control" placeholder="Digite o nome do bairro da vitima" maxlength="100">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-numero-vitima">Numero</label>'+
                    '<input type="number" name="numero-vitima-'+proximoNum+'" id="id-numero-vitima" class="form-control" placeholder="Numero da casa" max="6" min="0">'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="row">'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-estado-vitima">Estado</label>'+
                    '<select class="form-control select2" name="estado-vitima-'+proximoNum+'" id="id-estado-vitima" disabled>'+
                      '<option value="AC">Acre</option>'+
                      '<option value="AL">Alagoas</option>'+
                      '<option value="AP">Amapá</option>'+
                      '<option value="AM">Amazonas</option>'+
                      '<option value="BA">Bahia</option>'+
                      '<option value="CE">Ceará</option>'+
                      '<option value="DF">Distrito Federal</option>'+
                      '<option value="ES">Espirito Santos</option>'+
                      '<option value="GO">Goiás</option>'+
                      '<option value="MA">Maranhão</option>'+
                      '<option value="MT">Mato Grosso</option>'+
                      '<option value="MS">Mato Grosso do Sul</option>'+
                      '<option value="MG">Minas Gerais</option>'+
                      '<option value="PA">Pará</option>'+
                      '<option value="PB">Paraíba</option>'+
                      '<option value="PR">Paraná</option>'+
                      '<option value="PE">Pernambuco</option>'+
                      '<option value="PI">Piauí</option>'+
                      '<option value="RJ">Rio de Janeiro</option>'+
                      '<option value="RN">Rio Grande do Norte</option>'+
                      '<option value="RS">Rio Grande do Sul</option>'+
                      '<option value="RO">Rondônia</option>'+
                      '<option value="RR">Roraima</option>'+
                      '<option value="SC">Santa Catarina</option>'+
                      '<option value="SP" selected>São Paulo</option>'+
                      '<option value="SE">Sergipe</option>'+
                      '<option value="TO">Tocantins</option>'+
                    '</select>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-cidade-vitima">Cidade</label>'+
                    '<input type="text" name="cidade-vitima-'+proximoNum+'" id="id-cidade-vitima" class="form-control" value="Nova Campina" disabled="disabled">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<label for="id-complemento-vitima">Complemento</label>'+
                    '<input type="text" name="complemento-vitima-'+proximoNum+'" id="id-complemento-vitima" class="form-control" placeholder="Complemento" maxlength="100">'+
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