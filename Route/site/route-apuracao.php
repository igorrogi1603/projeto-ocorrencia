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

?>