<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CListaOcorrencia;
use \App\Controller\CDetalheOcorrencia;
use \App\Controller\COcorrenciaVitima;
use \App\Controller\COcorrenciaResponsavel;
use \App\Controller\COcorrenciaEnviarArquivo;
use \App\Controller\COcorrenciaAcompanhamento;
use \App\Controller\COcorrenciaAgressorCadastrar;
use \App\Controller\COcorrenciaAgressor;
use \App\Controller\COcorrenciaAgressorEnviarArquivo;
use \App\Controller\COcorrenciaDescricao;
use \App\Controller\COcorrenciaNovaSolicitacao;
use \App\Controller\COcorrenciaSolicitacao;
use \App\Controller\COcorrenciaStatus;
use \App\Controller\COcorrenciaArquivos;
use \App\Controller\COcorrenciaArquivoExterno;

$app->get("/ocorrencia-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$lista = COcorrenciaSolicitacao::getListaSolicitacao($idOcorrencia);

		$page = new Page();

		$page->setTpl("ocorrencia-solicitacao", [
			"idOcorrencia" => $idOcorrencia,
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

$app->get("/ocorrencia-nova-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$usuarios = COcorrenciaNovaSolicitacao::getNovaSolicitacaoUsuario();
		$vitima = COcorrenciaNovaSolicitacao::getNovaSolicitacaoVitima($idOcorrencia);

		$page = new Page();

		$page->setTpl("ocorrencia-nova-solicitacao", [
			"usuarios" => $usuarios,
			"vitima" => $vitima,
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

$app->post("/ocorrencia-nova-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		COcorrenciaNovaSolicitacao::postNovaSolicitacao($_POST, $idOcorrencia);

		header("Location: /ocorrencia-solicitacao/".$idOcorrencia);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-ler-solicitacao/:idOcorrencia/:idSolicitacao/:isInstituicao", function($idOcorrencia, $idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$lista = COcorrenciaSolicitacao::getlerSolicitacao($idOcorrencia, $idSolicitacao, $isInstituicao);

		$page = new Page();

		$page->setTpl("ocorrencia-ler-solicitacao", [
			"idOcorrencia" => $idOcorrencia, 
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

?>