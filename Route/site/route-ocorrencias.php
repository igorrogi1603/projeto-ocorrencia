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

/*Detalhes da Ocorrencia*/
$app->get("/ocorrencia-detalhe/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();
	
	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$detalheOcorrencia = CDetalheOcorrencia::getOcorrenciaDetalhe($idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		if (isset($detalheOcorrencia[0]['idOcorrencia'])) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
				foreach ($listaBlokOcorrencia as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						$page = new Page();

						$page->setTpl("ocorrencia-detalhe", [
							"detalheOcorrencia" => $detalheOcorrencia,
							"nivelAcesso" => $_SESSION['User']['nivelAcesso']
						]);
					} else {
						$page = new Page([
							"header"=>false,
							"footer"=>false
						]);
						$page->setTpl("404");
					}
				}
			} else {
				$page = new Page();

				$page->setTpl("ocorrencia-detalhe", [
					"detalheOcorrencia" => $detalheOcorrencia,
					"nivelAcesso" => $_SESSION['User']['nivelAcesso']
				]);
			}
		} else {
			$page = new Page([
				"header"=>false,
				"footer"=>false
			]);
			$page->setTpl("404");
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

//--------------------------------------------------------------

//Futuras atualizacao

/*$app->get("/ocorrencia-relatorio", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-relatorio");
});

$app->get("/ocorrencia-relatorio-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("ocorrencia-relatorio-print");	
});

$app->get("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-enviada");
});

$app->post("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	header('Location: /ocorrencia-enviada');
    exit;
});

$app->get("/ocorrencia-enviada-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/ocorrencia-enviada-print");	
});*/

?>