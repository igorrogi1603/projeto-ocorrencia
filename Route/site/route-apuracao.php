<?php 

use \App\Classe\Usuario;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;

$app->get("/criar-apuracao", function(){
	
	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("criar-apuracao");
});

$app->post("/criar-apuracao", function(){
	
	Usuario::verifyLogin();

	CCriarApuracao::postCriarApuracao($_POST);

	header("Location: /apuracao-enviada");
	exit;
});

$app->get("/apuracao-enviada", function(){

	Usuario::verifyLogin();
	
	$page = new Page();

	$page->setTpl("apuracao-enviada");
});

$app->get("/apuracao-enviada-print", function(){

	Usuario::verifyLogin();
	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("apuracao-enviada-print");
});

$app->get("/lista-apuracoes", function(){

	Usuario::verifyLogin();
	
	$page = new Page();

	$page->setTpl("lista-apuracoes");
});

$app->get("/apuracao-detalhe", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("apuracao-detalhe");
});

$app->get("/confirmar-apuracao", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("confirmar-apuracao");
});

$app->get("/confirmar-apuracao-detalhe", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("confirmar-apuracao-detalhe");
});

?>