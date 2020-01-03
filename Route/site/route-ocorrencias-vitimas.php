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

//Dentro da pagina detalhes
//--------------------------------------------------------------
//Vitimas
$app->get("/ocorrencia-vitimas-lista/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$vitimas = COcorrenciaVitima::getOcorrenciaVitimasLista($idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitimas-lista", [
						"vitimas" => $vitimas
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

			$page->setTpl("ocorrencia-vitimas-lista", [
				"vitimas" => $vitimas
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

$app->get("/ocorrencia-vitimas/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$vitima = COcorrenciaVitima::getOcorrenciaVitima($idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitimas", [
						"vitima" => $vitima,
						"idVitima" => $idVitima
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

			$page->setTpl("ocorrencia-vitimas", [
				"vitima" => $vitima,
				"idVitima" => $idVitima
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

$app->get("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$vitima = COcorrenciaVitima::getOcorrenciaVitimaEditar($idVitima, $idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitima-editar", [
						"vitima" => $vitima,
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

			$page->setTpl("ocorrencia-vitima-editar", [
				"vitima" => $vitima,
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

$app->post("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia/:idPessoa", function($idVitima, $idOcorrencia, $idPessoa){

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
					$vitima = COcorrenciaVitima::postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $_POST);

					header("Location: /ocorrencia-vitimas/".$idVitima."/".$idOcorrencia);
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
			$vitima = COcorrenciaVitima::postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $_POST);

			header("Location: /ocorrencia-vitimas/".$idVitima."/".$idOcorrencia);
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

$app->get("/ocorrencia-vitima-enviar-arquivo-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$dados = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrar($idVitima, $idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar", [
						"selecionaPessoa" => $dados,
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

			$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar", [
				"selecionaPessoa" => $dados,
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

$app->post("/ocorrencia-vitima-enviar-arquivo-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

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
					//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
					if($_FILES["upDocumento"]["name"] !== ""){
						COcorrenciaEnviarArquivo::postEnviarArquivoCadastrar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia);
					} else {
						Validacao::setMsgError("Selecione um arquivo PDF");
				        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
				        exit;
					}

					header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
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
			//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
			if($_FILES["upDocumento"]["name"] !== ""){
				COcorrenciaEnviarArquivo::postEnviarArquivoCadastrar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia);
			} else {
				Validacao::setMsgError("Selecione um arquivo PDF");
		        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
		        exit;
			}

			header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
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

$app->get("/ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar/:idVitima/:idOcorrencia/:idArquivo/:idPessoa/:tipo", function($idVitima, $idOcorrencia, $idArquivo, $idPessoa, $tipo){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$dados = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrarAtualizar($idVitima, $idOcorrencia, $idPessoa);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar", [
						"selecionaPessoa" => $dados,
						"idVitima" => $idVitima,
						"idOcorrencia" => $idOcorrencia,
						"idArquivo" => $idArquivo,
						"tipo" => $tipo,
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

			$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar", [
				"selecionaPessoa" => $dados,
				"idVitima" => $idVitima,
				"idOcorrencia" => $idOcorrencia,
				"idArquivo" => $idArquivo,
				"tipo" => $tipo,
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

$app->post("/ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar/:idVitima/:idOcorrencia/:idArquivo", function($idVitima, $idOcorrencia, $idArquivo){

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
					//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
					if($_FILES["upDocumento"]["name"] !== ""){
						COcorrenciaEnviarArquivo::postEnviarArquivoCadastrarAtualizar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia, $idArquivo);
					} else {
						Validacao::setMsgError("Selecione um arquivo PDF");
				        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
				        exit;
					}

					header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
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
			//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
			if($_FILES["upDocumento"]["name"] !== ""){
				COcorrenciaEnviarArquivo::postEnviarArquivoCadastrarAtualizar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia, $idArquivo);
			} else {
				Validacao::setMsgError("Selecione um arquivo PDF");
		        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
		        exit;
			}

			header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
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

$app->get("/ocorrencia-vitima-enviar-arquivo-lista/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$documento = COcorrenciaEnviarArquivo::getEnviarArquivoLista($idVitima, $idOcorrencia);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitima-enviar-arquivo-lista", [
						"idVitima" => $idVitima,
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
			}
		} else {
			$page = new Page();

			$page->setTpl("ocorrencia-vitima-enviar-arquivo-lista", [
				"idVitima" => $idVitima,
				"idOcorrencia" => $idOcorrencia,
				"documento" => $documento
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

$app->get("/ocorrencia-vitima-acompanhamento/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210"
	) {
		$acompanhamento = COcorrenciaAcompanhamento::getOcorrenciaAcompanhamento($idVitima);
		$listaBlokOcorrencia = CListaOcorrencia::listaBloquearOcorrencia($idOcorrencia);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokOcorrencia) && $listaBlokOcorrencia != "" && $listaBlokOcorrencia != null) {
			foreach ($listaBlokOcorrencia as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("ocorrencia-vitima-acompanhamento", [
						"acompanhamento" => $acompanhamento,
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
			$page = new Page();

			$page->setTpl("ocorrencia-vitima-acompanhamento", [
				"acompanhamento" => $acompanhamento,
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

?>