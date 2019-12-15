<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;
use \App\Controller\CListaApuracao;
use \App\Controller\CListaOcorrencia;

$app->get("/criar-apuracao", function(){
	
	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("criar-apuracao", [
		'error'=>Validacao::getMsgError()
	]);
});

$app->post("/criar-apuracao", function(){
	
	Usuario::verifyLogin();

	$idApuracao = CCriarApuracao::postCriarApuracao($_POST);

	header("Location: /apuracao-enviada/".$idApuracao[0]["MAX(idCriarApuracao)"]);
	exit;
});

$app->get("/apuracao-enviada/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	$apuracaoCompleta = CCriarApuracao::getApuracaoEnviada($idApuracao);

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente
	if (isset($apuracaoCompleta[0]['status']) && $apuracaoCompleta[0]['status'] == 1) {
		$page = new Page();

		$page->setTpl("apuracao-enviada", [
			"apuracaoCompleta" => $apuracaoCompleta
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}

});

$app->get("/apuracao-enviada-print/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();
	
	$apuracaoCompleta = CCriarApuracao::getApuracaoEnviada($idApuracao);

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente
	if (isset($apuracaoCompleta[0]['status']) && $apuracaoCompleta[0]['status'] == 1) {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);

		$page->setTpl("apuracao-enviada-print", [
			"apuracaoCompleta" => $apuracaoCompleta
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

//As rotas de cima nao estao validadas com nivel de acesso
//pois todos os usuario poderao criar apuracao (denuncia)

$app->get("/lista-apuracoes", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaApuracao = CListaApuracao::getListaApuracao();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaApuracao);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaApuracao[$i])) {
					//se existe guarda em id
					$id = $listaApuracao[$i]['idCriarApuracao'];
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
					unset($listaApuracao[$value]);
				}
			}

			$listaFinal = $listaApuracao;
		} else {
			$listaFinal = $listaApuracao;
		}

		$page = new Page();

		$page->setTpl("lista-apuracoes", [
			"listaApuracao" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}	
});

$app->get("/apuracao-detalhe/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						$page = new Page();

						$page->setTpl("apuracao-detalhe", [
							"detalheApuracao" => $detalheApuracao
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

				$page->setTpl("apuracao-detalhe", [
					"detalheApuracao" => $detalheApuracao
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

$app->get("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);

		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						$page = new Page();

						$page->setTpl("apuracao-descartar", [
							"idApuracao" => $idApuracao
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

				$page->setTpl("apuracao-descartar", [
					"idApuracao" => $idApuracao
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

$app->post("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

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

					header("Location: /lista-apuracoes");
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

			header("Location: /lista-apuracoes");
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

$app->get("/apuracao-detalhe/gerar-ocorrencia/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idApuracao);
		
		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
			//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
			//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
			if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
				foreach ($listaBlokApuracao as $value) {	
					if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
						CListaApuracao::getGerarOcorrencia($idApuracao);

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
				CListaApuracao::getGerarOcorrencia($idApuracao);

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

$app->get("/apuracao-excluida", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaApuracao = CListaApuracao::getListaApuracaoExcluida();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaApuracao);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaApuracao[$i])) {
					//se existe guarda em id
					$id = $listaApuracao[$i]['idCriarApuracao'];
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
					unset($listaApuracao[$value]);
				}
			}

			$listaFinal = $listaApuracao;
		} else {
			$listaFinal = $listaApuracao;
		}

		$page = new Page();

		$page->setTpl("apuracao-excluida", [
			"listaApuracao" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}	
});

$app->get("/apuracao-excluida-detalhe/:idCriarApuracao", function($idCriarApuracao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaApuracao = CListaApuracao::getApuracaoDetalheExcluida($idCriarApuracao);
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idCriarApuracao);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
			foreach ($listaBlokApuracao as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("apuracao-excluida-detalhe", [
						"listaApuracao" => $listaApuracao
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

			$page->setTpl("apuracao-excluida-detalhe", [
				"listaApuracao" => $listaApuracao
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

$app->get("/apuracao-excluida-detalhe/reabrir/:idApuracaoExcluida/:idCriarApuracao", function($idApuracaoExcluida, $idCriarApuracao){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {	
		$listaBlokApuracao = CListaOcorrencia::listaBloquearOcorrenciaApuracao($idCriarApuracao);

		//Caso o usuario tenha aparecido em alguam apuracao ele nao podera ver
		//validacao para nao deixar o usuario acessar a rota onde seu nome aparece na apuracao
		if (isset($listaBlokApuracao) && $listaBlokApuracao != "" && $listaBlokApuracao != null) {
			foreach ($listaBlokApuracao as $value) {	
				if ($_SESSION['User']['idUsuario'] != $value['idUsuario']) {
					$page = new Page();

					$page->setTpl("apuracao-excluida-reabrir", [
						"idApuracaoExcluida" => $idApuracaoExcluida,
						"idApuracao" => $idCriarApuracao
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

			$page->setTpl("apuracao-excluida-reabrir", [
				"idApuracaoExcluida" => $idApuracaoExcluida,
				"idApuracao" => $idCriarApuracao
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

$app->post("/apuracao-excluida-detalhe/reabrir/:idApuracaoExcluida/:idApuracao", function($idApuracaoExcluida, $idApuracao){

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
					CListaApuracao::postReabrirApuracao($idApuracaoExcluida, $idApuracao, $_POST);

					header("Location: /lista-apuracoes");
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
			CListaApuracao::postReabrirApuracao($idApuracaoExcluida, $idApuracao, $_POST);

			header("Location: /lista-apuracoes");
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