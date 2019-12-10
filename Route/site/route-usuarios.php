<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCadastrarUsuario;
use \App\Controller\CListaUsuario;
use \App\Controller\CDetalheUsuario;

$app->get('/usuarios-cadastrar', function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$page = new Page();

		$page->setTpl("usuarios-cadastrar", [
			'error'=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post('/usuarios-cadastrar', function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		CCadastrarUsuario::postCadastrarUsuario($_POST);

		header('Location: /usuarios-lista');
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-lista', function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$listaUsuarios = CListaUsuario::getListaUsuario();

		$page = new Page();

		$page->setTpl("usuarios-lista", [
			'listaUsuario' => $listaUsuarios
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-detalhe/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$detalheUsuario = CDetalheUsuario::getDetalheUsuario($idUsuario);

		$page = new Page();

		$page->setTpl("usuarios-detalhe", [
			"detalheUsuario" => $detalheUsuario
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-detalhe/editar/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$dadosUsuario = CDetalheUsuario::getEditar($idUsuario);

		$page = new Page();

		$page->setTpl("usuarios-detalhe-editar", [
			'dadosUsuario' => $dadosUsuario,
			'error'=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post('/usuarios-detalhe/editar/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		CDetalheUsuario::postEditar($_POST, $idUsuario);

		header('Location: /usuarios-detalhe/'.$idUsuario);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-detalhe/bloquear/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		CDetalheUsuario::getBloquear($idUsuario);

		header('Location: /usuarios-detalhe/'.$idUsuario);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-detalhe/desbloquear/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		CDetalheUsuario::getDesbloquear($idUsuario);

		header('Location: /usuarios-detalhe/'.$idUsuario);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/usuarios-alterar-senha/senha/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$page = new Page();

		$page->setTpl("usuarios-alterar-senha", [
			"idUsuario" => $idUsuario
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post('/usuarios-alterar-senha/senha/:idUsuario', function($idUsuario){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "3" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		CDetalheUsuario::postAlterarSenha($_POST, $idUsuario);

		header('Location: /usuarios-detalhe/'.$idUsuario);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

?>