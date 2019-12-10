<?php

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CLogin;
use \App\Config\Page;

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

?>