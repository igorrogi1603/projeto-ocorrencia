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

$app->get('/solicitacao-responder/:idSolicitacao/:isInstituicao/:idOcorrencia', function($idSolicitacao, $isInstituicao, $idOcorrencia){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("solicitacao-responder", [
		"idSolicitacao" => $idSolicitacao,
		"isInstituicao" => $isInstituicao,
		"idOcorrencia" => $idOcorrencia
	]);

});

$app->post('/solicitacao-responder/:idSolicitacao/:isInstituicao/:idOcorrencia', function($idSolicitacao, $isInstituicao, $idOcorrencia){

	Usuario::verifyLogin();

	CSolicitacoes::postSolicitacaoResponder($_POST, $idSolicitacao, $idOcorrencia, $isInstituicao);

	header("Location: /ler-solicitacao/".$idSolicitacao."/".$isInstituicao);
	exit;
});

$app->get('/solicitacoes-lixeira', function(){

	Usuario::verifyLogin();

	$lista = CSolicitacoes::getListaSolicitacoes($_SESSION['User']['idUsuario']);

	$page = new Page();

	$page->setTpl("solicitacoes-lixeira", [
		"mensagem" => $lista
	]);
});

$app->get('/solicitacao-lixeira/:idSolicitacao/:isInstituicao', function($idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	CSolicitacoes::getSolicitacoesLixeira($idSolicitacao);

	header("Location: /solicitacoes");
	exit;
});

?>