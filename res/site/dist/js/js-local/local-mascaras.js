/*Pagina: Criar Ocorrência e apuracao- Mascara Vitima
---------------------------------------------------------------*/
$('#id-data-nasc-vitima').mask('00/00/0000', {reverse: true});
$('#id-cpf-vitima').mask('000.000.000-00', {reverse: true});
$('#id-cpf-responsavel-vitima').mask('000.000.000-00', {reverse: true});
$('#id-rg-vitima').mask('00.000.000', {reverse: true});
$('#id-celular-responsavel-vitima').mask('00 - 00000-0000', {reverse: true});
$('#id-celular-vitima').mask('00 - 00000-0000', {reverse: true});
$('#id-telfixo-vitima').mask('00 - 0000-0000', {reverse: true});
$('#id-cep-vitima').mask('00000-000', {reverse: true});
//Pelo fato de adicionar varias vitimas
for (let i = 0; i <= 100; i++) {
	$('#id-cep-vitima-'+i).mask('00000-000', {reverse: true});
	$('#id-cpf-vitima-'+i).mask('000.000.000-00', {reverse: true});
	$('#id-data-nasc-vitima-'+i).mask('00/00/0000', {reverse: true});
	$('#id-cpf-responsavel-vitima-'+i).mask('000.000.000-00', {reverse: true});
	$('#id-celular-responsavel-vitima-'+i).mask('00 - 00000-0000', {reverse: true});
	$('#id-celular-vitima-'+i).mask('00 - 00000-0000', {reverse: true});
}

/*Pagina: Ocorrência Agressor - Mascara Agressor
---------------------------------------------------------------*/
$('#id-data-nasc-agressor').mask('00/00/0000', {reverse: true});
$('#id-cpf-agressor').mask('000.000.000-00', {reverse: true});
$('#id-rg-agressor').mask('00.000.000', {reverse: true});
$('#id-celular-agressor').mask('00 - 00000-0000', {reverse: true});
$('#id-telfixo-agressor').mask('00 - 0000-0000', {reverse: true});
$('#id-cep-agressor').mask('00000-000', {reverse: true});
$('#id-cnpj-instituicao').mask('00.000.000/0000-00', {reverse: true});
$('#id-celular-instituicao').mask('00 - 00000-0000', {reverse: true});
$('#id-telfixo-instituicao').mask('00 - 0000-0000', {reverse: true});
$('#id-cep-instituicao').mask('00000-000', {reverse: true});

/*Pagina: Cadastrar Usuario - Mascara
--------------------------------------------------------------*/
$('#id-data-nasc-usuario').mask('00/00/0000', {reverse: true});
$('#id-cpf-usuario').mask('000.000.000-00', {reverse: true});
$('#id-rg-usuario').mask('00.000.000', {reverse: true});
$('#id-celular-usuario').mask('00 - 00000-0000', {reverse: true});
$('#id-telfixo-usuario').mask('00 - 0000-0000', {reverse: true});
$('#id-cep-usuario').mask('00000-000', {reverse: true});

/*Pagina: Ocorrencia responsavel vitima editar*/
$('#id-data-nasc-responsavel').mask('00/00/0000', {reverse: true});
$('#id-cpf-responsavel').mask('000.000.000-00', {reverse: true});
$('#id-rg-responsavel').mask('00.000.000', {reverse: true});
$('#id-celular-responsavel').mask('00 - 00000-0000', {reverse: true});
$('#id-telfixo-responsavel').mask('00 - 0000-0000', {reverse: true});
$('#id-cep-responsavel').mask('00000-000', {reverse: true});