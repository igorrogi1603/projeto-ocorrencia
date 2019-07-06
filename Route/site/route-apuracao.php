<?php 

use \App\Config\Page;

$app->get("/criar-apuracao", function(){
	
	$page = new Page();

	$page->setTpl("criar-apuracao");
});

$app->get("/apuracao-enviada", function(){
	
	$page = new Page();

	$page->setTpl("apuracao-enviada");
});

$app->post("/apuracao-enviada", function(){
	
	header("Location: /apuracao-enviada");
	exit;	
});

$app->get("/apuracao-enviada-print", function(){
	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("apuracao-enviada-print");
});

$app->get("/lista-apuracoes", function(){
	
	$page = new Page();

	$page->setTpl("lista-apuracoes");
});

?>