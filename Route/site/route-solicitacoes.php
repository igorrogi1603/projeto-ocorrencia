<?php 

use \App\Classe\Usuario;
use \App\Config\Page;
use \App\Controller\CSolicitacoes;

$app->get('/solicitacoes', function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$lista = CSolicitacoes::getListaSolicitacoes($_SESSION['User']['idUsuario']);

		$page = new Page();

		$page->setTpl("solicitacoes", [
			"mensagem" => $lista
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/ler-solicitacao/:idSolicitacao/:isInstituicao', function($idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$lista = CSolicitacoes::getlerSolicitacao($idSolicitacao, $isInstituicao);

		$page = new Page();

		$page->setTpl("ler-solicitacao", [
			"mensagem" => $lista
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/solicitacao-responder/:idSolicitacao/:isInstituicao/:idOcorrencia', function($idSolicitacao, $isInstituicao, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$page = new Page();

		$page->setTpl("solicitacao-responder", [
			"idSolicitacao" => $idSolicitacao,
			"isInstituicao" => $isInstituicao,
			"idOcorrencia" => $idOcorrencia
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post('/solicitacao-responder/:idSolicitacao/:isInstituicao/:idOcorrencia', function($idSolicitacao, $isInstituicao, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		CSolicitacoes::postSolicitacaoResponder($_POST, $idSolicitacao, $idOcorrencia, $isInstituicao);

		header("Location: /ler-solicitacao/".$idSolicitacao."/".$isInstituicao);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/solicitacoes-lixeira', function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$lista = CSolicitacoes::getListaSolicitacoes($_SESSION['User']['idUsuario']);

		$page = new Page();

		$page->setTpl("solicitacoes-lixeira", [
			"mensagem" => $lista
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get('/solicitacao-lixeira/:idSolicitacao/:isInstituicao', function($idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "2" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		CSolicitacoes::getSolicitacoesLixeira($idSolicitacao);

		header("Location: /solicitacoes");
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