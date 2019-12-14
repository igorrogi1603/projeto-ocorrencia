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

$app->get("/ocorrencia-arquivo-externo/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$page = new Page();

		$page->setTpl("ocorrencia-arquivo-externo", [
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

$app->post("/ocorrencia-arquivo-externo/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
		if($_FILES["upDocumento"]["name"] !== ""){
			COcorrenciaArquivoExterno::postEnviarAquivoExterno($idOcorrencia, $_POST, $_FILES["upDocumento"]);
		} else {
			Validacao::setMsgError("Selecione um arquivo PDF");
	        header('Location: /ocorrencia-arquivo-externo/'.$idOcorrencia);
	        exit;
		}

		header("Location: /ocorrencia-detalhe/".$idOcorrencia);
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