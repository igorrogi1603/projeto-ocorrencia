<?php 

use \App\Config\Page;
use \App\Controller\CCadastrarUsuario;

$app->get('/usuarios-cadastrar', function(){

	$page = new Page();

	$page->setTpl("usuarios-cadastrar");

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