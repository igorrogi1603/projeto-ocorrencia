<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Controller\CListaOcorrencia;

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
	
	$page = new Page();

	$page->setTpl("ocorrencia-detalhe");
});

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