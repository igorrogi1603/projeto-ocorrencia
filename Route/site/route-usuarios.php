<?php 

use \App\Classe\Usuario;
use \App\Config\Page;
use \App\Controller\CCadastrarUsuario;
use \App\Classe\Validacao;

$app->get('/usuarios-cadastrar', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("usuarios-cadastrar", [
		'error'=>Validacao::getMsgError()
	]);

});

$app->post('/usuarios-cadastrar', function(){

	Usuario::verifyLogin();

	CCadastrarUsuario::postCadastrarUsuario($_POST);

	header('Location: /usuarios-lista');
	exit;

});

$app->get('/usuarios-lista', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("usuarios-lista");

});

?>