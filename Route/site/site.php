<?php

use \App\Config\Page;

$app->get("/", function(){

	$page = new Page();

	$page->setTpl("inicio");
});

$app->get("/login", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->get("/criar-ocorrencia", function(){

	$page = new Page();

	$page->setTpl("criar-ocorrencia");
});

$app->get("/ocorrencia-enviada", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-enviada");
});

$app->post("/ocorrencia-enviada", function(){

	header('Location: /ocorrencia-enviada');
    exit;
});

$app->get("/ocorrencia-enviada-print", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/ocorrencia-enviada-print");	
});

$app->get("/ocorrencias-abertas", function(){

	$page = new Page();

	$page->setTpl("ocorrencias-abertas");
});

$app->get("/ocorrencia-detalhe", function(){

	$page = new Page();

	$page->setTpl("/ocorrencia-detalhe");
});
?>