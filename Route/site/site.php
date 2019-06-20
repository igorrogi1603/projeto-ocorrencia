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

?>