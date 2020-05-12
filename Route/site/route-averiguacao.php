<?php

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarAveriguacao;

$app->get("/criar-averiguacao", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("criar-averiguacao");
});

$app->post("/criar-averiguacao", function(){

	Usuario::verifyLogin();
	
	CCriarAveriguacao::postCriarAveriguacao($_POST);

	header("Location: /averiguacao");
	exit;
});

$app->get("/averiguacao", function(){

	Usuario::verifyLogin();
	
	$lista = CCriarAveriguacao::getAveriguacao();

	$page = new Page();

	$page->setTpl("averiguacao", [
		"lista" => $lista
	]);
});

$app->get("/averiguacao-detalhe/:idAveriguacao", function($idAveriguacao){

	Usuario::verifyLogin();
	
	$lista = CCriarAveriguacao::getAveriguacaoDetalhe($idAveriguacao);

	$page = new Page();

	$page->setTpl("averiguacao-detalhe", [
		"lista" => $lista
	]);
});

$app->get("/averiguacao-detalhe/lida/:idAveriguacao", function($idAveriguacao){

	Usuario::verifyLogin();
	
	CCriarAveriguacao::getAveriguacaoDetalheLida($idAveriguacao);

	header("Location: /averiguacao-lida");
	exit;
});

$app->get("/averiguacao-lida", function(){

	Usuario::verifyLogin();
	
	$lista = CCriarAveriguacao::getAveriguacaoLida();

	$page = new Page();

	$page->setTpl("averiguacao-lida", [
		"lista" => $lista
	]);
});

?>