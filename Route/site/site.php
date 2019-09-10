<?php

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CLogin;
use \App\Config\Page;

$app->get("/", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("inicio");
});

$app->get("/login", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login", [
		'error'=>Validacao::getMsgError()
	]);
});

$app->post("/login", function(){

	CLogin::postLogar($_POST);

});

$app->get("/logout", function(){

	Usuario::verifyLogin();
	
	Usuario::logout();

	header("Location: /login");
	exit;

});

//Rotas externas
require_once("route-ocorrencias.php");
require_once("route-apuracao.php");
require_once("route-solicitacoes.php");
require_once("route-usuarios.php");
?>