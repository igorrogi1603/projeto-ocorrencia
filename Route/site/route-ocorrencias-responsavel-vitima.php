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

//RESPONSAVEL PELA VITIMA
$app->get("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-responsavel-vitima-cadastrar", [
						"idVitima" => $idVitima,
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
			}
		} else {
			$page = new Page();

			$page->setTpl("ocorrencia-responsavel-vitima-cadastrar", [
				"idVitima" => $idVitima,
				"idOcorrencia" => $idOcorrencia,
				"error"=>Validacao::getMsgError()
			]);
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					COcorrenciaResponsavel::postCadastrarResponsavelVitima($idVitima, $idOcorrencia, $_POST);

					header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
					exit;
				} else {
					$page = new Page([
						"header"=>false,
						"footer"=>false
					]);
					$page->setTpl("404");
				}
			}
		} else {
			COcorrenciaResponsavel::postCadastrarResponsavelVitima($idVitima, $idOcorrencia, $_POST);

			header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
			exit;
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-responsavel-vitima-detalhe/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$responsavel = COcorrenciaResponsavel::getDetalheResponsavelVitima($idPessoaResponsavel);

					$page = new Page();

					$page->setTpl("ocorrencia-responsavel-vitima-detalhe", [
						"responsavel" => $responsavel,
						"idVitima" => $idVitima,
						"idOcorrencia" => $idOcorrencia
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
			$responsavel = COcorrenciaResponsavel::getDetalheResponsavelVitima($idPessoaResponsavel);

			$page = new Page();

			$page->setTpl("ocorrencia-responsavel-vitima-detalhe", [
				"responsavel" => $responsavel,
				"idVitima" => $idVitima,
				"idOcorrencia" => $idOcorrencia
			]);
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-responsavel-vitima-lista/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$responsavel = COcorrenciaResponsavel::getListaResponsavelVitima($idVitima, $idOcorrencia);

					$page = new Page();

					$page->setTpl("ocorrencia-responsavel-vitima-lista", [
						"responsavel" => $responsavel,
						"error"=>Validacao::getMsgError()
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
			$responsavel = COcorrenciaResponsavel::getListaResponsavelVitima($idVitima, $idOcorrencia);

			$page = new Page();

			$page->setTpl("ocorrencia-responsavel-vitima-lista", [
				"responsavel" => $responsavel,
				"error"=>Validacao::getMsgError()
			]);
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$responsavel = COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel);

					$page = new Page();

					$page->setTpl("ocorrencia-responsavel-vitima-editar", [
						"responsavel" => $responsavel,
						"error"=>Validacao::getMsgError()
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
			$responsavel = COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel);

			$page = new Page();

			$page->setTpl("ocorrencia-responsavel-vitima-editar", [
				"responsavel" => $responsavel,
				"error"=>Validacao::getMsgError()
			]);
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					COcorrenciaResponsavel::postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel, $_POST);

					header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
					exit;
				} else {
					$page = new Page([
						"header"=>false,
						"footer"=>false
					]);
					$page->setTpl("404");
				}
			}
		} else {
			COcorrenciaResponsavel::postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel, $_POST);

			header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
			exit;
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencia-responsavel-vitima-excluir/:idVitima/:idOcorrencia/:idPessoaResponsavel/:idResponsavelApuracao/:idCriarApuracao", function($idVitima, $idOcorrencia, $idPessoaResponsavel, $idResponsavelApuracao, $idCriarApuracao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("responsavel-descartar", [
						"idVitima" => $idVitima,
						"idOcorrencia" => $idOcorrencia,
						"idPessoaResponsavel" => $idPessoaResponsavel,
						"idResponsavelApuracao" => $idResponsavelApuracao,
						"idCriarApuracao" => $idCriarApuracao
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

			$page->setTpl("responsavel-descartar", [
				"idVitima" => $idVitima,
				"idOcorrencia" => $idOcorrencia,
				"idPessoaResponsavel" => $idPessoaResponsavel,
				"idResponsavelApuracao" => $idResponsavelApuracao,
				"idCriarApuracao" => $idCriarApuracao
			]);
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->post("/ocorrencia-responsavel-vitima-excluir/:idVitima/:idOcorrencia/:idPessoaResponsavel/:idResponsavelApuracao/:idCriarApuracao", function($idVitima, $idOcorrencia, $idPessoaResponsavel, $idResponsavelApuracao, $idCriarApuracao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {	
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaExcluir($idResponsavelApuracao, $_POST, $idCriarApuracao, $idOcorrencia, $idVitima, $idPessoaResponsavel);

					header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
					exit;
				} else {
					$page = new Page([
						"header"=>false,
						"footer"=>false
					]);
					$page->setTpl("404");
				}
			}
		} else {
			COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaExcluir($idResponsavelApuracao, $_POST, $idCriarApuracao, $idOcorrencia, $idVitima, $idPessoaResponsavel);

			header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
			exit;
		}
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

?>