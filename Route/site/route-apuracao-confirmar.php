<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;
use \App\Controller\CListaApuracao;
use \App\Controller\CListaOcorrencia;
use \App\Controller\CListaConfirmacao;

$app->get("/confirmar-apuracao", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$confirmarApuracao = CListaConfirmacao::getListaConfirmacao();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($confirmarApuracao);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($confirmarApuracao[$i])) {
					//se existe guarda em id
					$id = $confirmarApuracao[$i]['idCriarApuracao'];
				}
				
				//Compara com outro array
				for ($a = 0; $a < $tamanhoArrayUsuario; $a++) {
					//Se os id forem iguais entao exclui para nao duplicar
					if ($id == $listaBloquearOcorrenciaUsuario[$a]['idCriarApuracao']) {
						$arrayPosicaoExcluir[] = $i;
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($confirmarApuracao[$value]);
				}
			}

			$listaFinal = $confirmarApuracao;
		} else {
			$listaFinal = $confirmarApuracao;
		}

		$page = new Page();

		$page->setTpl("confirmar-apuracao", [
			"confirmarApuracao" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/confirmar-apuracao-detalhe/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {

		$confirmacaoDetalhe = CListaConfirmacao::getConfirmacaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {	
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						$page = new Page();

						$page->setTpl("confirmar-apuracao-detalhe", [
							"confirmacaoDetalhe" => $confirmacaoDetalhe,
							"error" => Validacao::getMsgError()
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

				$page->setTpl("confirmar-apuracao-detalhe", [
					"confirmacaoDetalhe" => $confirmacaoDetalhe,
					"error" => Validacao::getMsgError()
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

$app->get("/confirmacao-positivo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {

		$confirmacaoDetalhe = CListaConfirmacao::getConfirmacaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						CListaConfirmacao::getConfirmacaoPositivo($idApuracao, $idConfirmacao);

						header('Location: /ocorrencias-abertas');
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
				CListaConfirmacao::getConfirmacaoPositivo($idApuracao, $idConfirmacao);

				header('Location: /ocorrencias-abertas');
				exit;
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

$app->get("/confirmacao-negativo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$confirmacaoDetalhe = CListaConfirmacao::getConfirmacaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {	
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						CListaConfirmacao::getConfirmacaoNegativo($idApuracao, $idConfirmacao);

						header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
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
				CListaConfirmacao::getConfirmacaoNegativo($idApuracao, $idConfirmacao);

				header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
				exit;
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

$app->get("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {

		$confirmacaoDetalhe = CListaConfirmacao::getConfirmacaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						$page = new Page();

						$page->setTpl("confirmacao-descartar", [
							"idApuracao" => $idApuracao,
							"idConfirmacao" => $idConfirmacao
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

				$page->setTpl("confirmacao-descartar", [
					"idApuracao" => $idApuracao,
					"idConfirmacao" => $idConfirmacao
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

$app->get("/confirmacao-detalhe/cancelar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {

		$confirmacaoDetalhe = CListaConfirmacao::getConfirmacaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						CListaConfirmacao::confirmacaoDetalheCancelar($idConfirmacao);

						header("Location: /confirmar-apuracao");
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
				CListaConfirmacao::confirmacaoDetalheCancelar($idConfirmacao);

				header("Location: /confirmar-apuracao");
				exit;
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

$app->post("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
			foreach ($listaBlokApuracao as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {		
					CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

					header("Location: /confirmar-apuracao");
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
			CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

			header("Location: /confirmar-apuracao");
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