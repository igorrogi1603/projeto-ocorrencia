<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCadastrarUsuario;
use \App\Controller\CListaUsuario;
use \App\Controller\CDetalheUsuario;

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

	$listaUsuarios = CListaUsuario::getListaUsuario();

	$page = new Page();

	$page->setTpl("usuarios-lista", [
		'listaUsuario' => $listaUsuarios
	]);

});

$app->get('/usuarios-detalhe/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	$detalheUsuario = CDetalheUsuario::getDetalheUsuario($idUsuario);

	$page = new Page();

	$page->setTpl("usuarios-detalhe", [
		"detalheUsuario" => $detalheUsuario
	]);

});

?>