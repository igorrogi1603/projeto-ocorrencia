<?php 

use \App\Classe\Usuario;
use \App\Config\Page;
use \App\Controller\CSolicitacoes;

$app->get('/solicitacoes', function(){

	Usuario::verifyLogin();

	$lista = CSolicitacoes::getListaSolicitacoes($_SESSION['User']['idUsuario']);

	$page = new Page();

	$page->setTpl("solicitacoes", [
		"mensagem" => $lista
	]);

});

$app->get('/ler-solicitacao/:idSolicitacao/:isInstituicao', function($idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	$lista = CSolicitacoes::getlerSolicitacao($idSolicitacao, $isInstituicao);

	$page = new Page();

	$page->setTpl("ler-solicitacao", [
		"mensagem" => $lista
	]);

});

$app->get('/solicitacoes-lixeira', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("solicitacoes-lixeira");

});

?>