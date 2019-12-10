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

$app->get("/ocorrencia-agressor/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$listaAgressor = COcorrenciaAgressor::getListaAgressor($idOcorrencia);

		$page = new Page();

		$page->setTpl("ocorrencia-agressor", [
			"idOcorrencia" => $idOcorrencia,
			"agressor" => $listaAgressor
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-agressor-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$page = new Page();

		$page->setTpl("ocorrencia-agressor-cadastrar", [
			"idOcorrencia" => $idOcorrencia,
			"error"=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-agressor-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		COcorrenciaAgressorCadastrar::postAgressorCadastrar($idOcorrencia, $_POST);

		header("Location: /ocorrencia-agressor/".$idOcorrencia);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-agressor-detalhe/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaAgressor = COcorrenciaAgressor::getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

		$page = new Page();

		$page->setTpl("ocorrencia-agressor-detalhe", [
			"idOcorrencia" => $idOcorrencia,
			"isInstituicao" => $isInstituicao,
			"agressor" => $listaAgressor
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-agressor-editar/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaAgressor = COcorrenciaAgressor::getAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

		//Operador ternario -> decidir qual template vai ser carregado
		$template = $isInstituicao == 0 ? "ocorrencia-agressor-editar" : "ocorrencia-instituicao-editar";

		$page = new Page();

		$page->setTpl($template, [
			"idOcorrencia" => $idOcorrencia,
			"isInstituicao" => $isInstituicao,
			"agressor" => $listaAgressor,
			"error"=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-agressor-editar/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		COcorrenciaAgressor::postAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $_POST);

		header("Location: /ocorrencia-agressor/".$idOcorrencia);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}	
});

$app->get("/ocorrencia-agressor-excluir/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaAgressor = COcorrenciaAgressor::getAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

		$page = new Page();

		$page->setTpl("agressor-descartar", [
			"idOcorrencia" => $idOcorrencia,
			"isInstituicao" => $isInstituicao,
			"agressor" => $listaAgressor,
			"error"=>Validacao::getMsgError(),
			"idOcorrenciaAgressor" => $idOcorrenciaAgressor
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-agressor-excluir/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor/:idAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor, $idAgressor){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		COcorrenciaAgressor::postAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $_POST, $idAgressor);

		header("Location: /ocorrencia-agressor/".$idOcorrencia);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

//Enviar Arquivo Agressor
$app->get("/ocorrencia-agressor-enviar-arquivo/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$documento = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoLista($idOcorrencia);

		$page = new Page();

		$page->setTpl("ocorrencia-agressor-enviar-arquivo", [
			"idOcorrencia" => $idOcorrencia,
			"documento" => $documento
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-agressor-enviar-arquivo-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaAgressor = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrar($idOcorrencia);

		$page = new Page();

		$page->setTpl("ocorrencia-agressor-enviar-arquivo-cadastrar", [
			"selecionaPessoa" => $listaAgressor,
			"idOcorrencia" => $idOcorrencia,
			"error"=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-agressor-enviar-arquivo-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
		if($_FILES["upDocumento"]["name"] !== ""){
			COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrar($idOcorrencia, $_POST, $_FILES["upDocumento"]);
		} else {
			Validacao::setMsgError("Selecione um arquivo PDF");
	        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
	        exit;
		}

		header("Location: /ocorrencia-agressor-enviar-arquivo/".$idOcorrencia);
		exit;
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/:idOcorrencia/:idPessoa/:idArquivo", function($idOcorrencia, $idPessoa, $idArquivo){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaAgressor = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrarAtualizar($idOcorrencia, $idPessoa);

		$page = new Page();

		$page->setTpl("ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar", [
			"selecionaPessoa" => $listaAgressor,
			"idOcorrencia" => $idOcorrencia,
			"idArquivo" => $idArquivo,
			"error"=>Validacao::getMsgError()
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/:idOcorrencia/:idArquivo", function($idOcorrencia, $idArquivo){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
		if($_FILES["upDocumento"]["name"] !== ""){
			COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrarAtualizar($idOcorrencia, $_POST, $_FILES["upDocumento"], $idArquivo);
		} else {
			Validacao::setMsgError("Selecione um arquivo PDF");
	        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
	        exit;
		}

		header("Location: /ocorrencia-agressor-enviar-arquivo/".$idOcorrencia);
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