<?php 

use \App\Config\Page;
use \App\Controller\CCadastrarUsuario;
use \App\Classe\Pessoa;

$app->get('/usuarios-cadastrar', function(){

	$page = new Page();

	$page->setTpl("usuarios-cadastrar", [
		'error'=>Pessoa::getMsgError()
	]);

});

$app->post('/usuarios-cadastrar', function(){

	CCadastrarUsuario::postCadastrarUsuario($_POST);

	header('Location: /usuarios-lista');
	exit;

});

$app->get('/usuarios-lista', function(){

	$page = new Page();

	$page->setTpl("usuarios-lista");

});

?>