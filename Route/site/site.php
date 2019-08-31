<?php

use App\Config\Page;

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

//Rotas externas
require_once("route-ocorrencias.php");
require_once("route-apuracao.php");
require_once("route-solicitacoes.php");
require_once("route-usuarios.php");
?>