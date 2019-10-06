<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CListaOcorrencia;
use \App\Controller\CDetalheOcorrencia;
use \App\Controller\COcorrenciaVitima;
use \App\Controller\COcorrenciaResponsavel;

//QUATRO FASES DA OCORRENCIA
$app->get("/ocorrencias-abertas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-abertas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-reabertas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-reabertas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-arquivadas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-arquivadas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-encerradas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-encerradas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

//--------------------------------------------------------------

/*Detalhes da Ocorrencia*/
$app->get("/ocorrencia-detalhe/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();
	
	$detalheOcorrencia = CDetalheOcorrencia::getOcorrenciaDetalhe($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-detalhe", [
		"detalheOcorrencia" => $detalheOcorrencia
	]);
});

//Dentro da pagina detalhes
//--------------------------------------------------------------
//Vitimas
$app->get("/ocorrencia-vitimas-lista/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$vitimas = COcorrenciaVitima::getOcorrenciaVitimasLista($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitimas-lista", [
		"vitimas" => $vitimas
	]);
});

$app->get("/ocorrencia-vitimas/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::getOcorrenciaVitima($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitimas", [
		"vitima" => $vitima,
		"idVitima" => $idVitima
	]);
});

$app->get("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::getOcorrenciaVitimaEditar($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-editar", [
		"vitima" => $vitima,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia/:idPessoa", function($idVitima, $idOcorrencia, $idPessoa){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $_POST);

	header("Location: /ocorrencia-vitimas/".$idVitima."/".$idOcorrencia);
	exit;
});

//RESPONSAVEL PELA VITIMA
$app->get("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-cadastrar", [
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaResponsavel::postCadastrarResponsavelVitima($idVitima, $idOcorrencia);

	header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-responsavel-vitima-lista/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$responsavel = COcorrenciaResponsavel::getListaResponsavelVitima($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-lista", [
		"responsavel" => $responsavel,
		"error"=>Validacao::getMsgError()
	]);
});

$app->get("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$vitima = COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-editar", [
		"vitima" => $vitima,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia/:idPessoa", function($idVitima, $idOcorrencia, $idPessoa){

	Usuario::verifyLogin();

	COcorrenciaResponsavel::postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $_POST);

	header("Location:");
	exit;

});

//--------------------------------------------------------------
//TESTE DEPOIS EXCLUIR ESSA ROTA
$app->get("/criar-ocorrencia", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("criar-ocorrencia");
});

//--------------------------------------------------------------

$app->get("/ocorrencia-relatorio", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-relatorio");
});

$app->get("/ocorrencia-relatorio-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("ocorrencia-relatorio-print");	
});

$app->get("/ocorrencia-arquivos", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-arquivos");
});

$app->get("/ocorrencia-solicitacao", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-solicitacao");
});

$app->get("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-enviada");
});

$app->post("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	header('Location: /ocorrencia-enviada');
    exit;
});

$app->get("/ocorrencia-enviada-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/ocorrencia-enviada-print");	
});
?>