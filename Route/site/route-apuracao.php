<?php 

use \App\Config\Page;

$app->get("/criar-apuracao-etapa1", function(){
	
	$page = new Page();

	$page->setTpl("criar-apuracao-etapa1");
});

$app->get("/criar-apuracao-etapa2", function(){
	
	$page = new Page();

	$page->setTpl("criar-apuracao-etapa2");
});

$app->post("/criar-apuracao-etapa2", function(){
	
	header("Location: /criar-apuracao-etapa2");
	exit;	
});

$app->get("/criar-apuracao-etapa3", function(){
	
	$page = new Page();

	$page->setTpl("criar-apuracao-etapa3");
});

$app->post("/criar-apuracao-etapa3", function(){
	
	header("Location: /criar-apuracao-etapa3");
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

$app->get("/apuracao-teste", function(){
	
	$page = new Page();

	$page->setTpl("apuracao-teste");
});

?>