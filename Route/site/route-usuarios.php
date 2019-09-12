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

$app->get('/usuarios-detalhe/editar/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	$dadosUsuario = CDetalheUsuario::getEditar($idUsuario);

	$page = new Page();

	$page->setTpl("usuarios-detalhe-editar", [
		'dadosUsuario' => $dadosUsuario,
		'error'=>Validacao::getMsgError()
	]);

});

$app->post('/usuarios-detalhe/editar/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	CDetalheUsuario::postEditar($_POST, $idUsuario);

	header('Location: /usuarios-detalhe/'.$idUsuario);
	exit;
});

$app->get('/usuarios-detalhe/bloquear/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	CDetalheUsuario::getBloquear($idUsuario);

	header('Location: /usuarios-detalhe/'.$idUsuario);
	exit;
});

$app->get('/usuarios-detalhe/desbloquear/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	CDetalheUsuario::getDesbloquear($idUsuario);

	header('Location: /usuarios-detalhe/'.$idUsuario);
	exit;
});

$app->get('/usuarios-detalhe/excluir/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	CDetalheUsuario::getExcluir($idUsuario);

	header('Location: /usuarios-lista');
	exit;
});

?>