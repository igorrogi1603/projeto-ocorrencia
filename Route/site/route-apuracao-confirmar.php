<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;
use \App\Controller\CListaApuracao;
use \App\Controller\CListaConfirmacao;

$app->get("/confirmar-apuracao", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$confirmarApuracao = CListaConfirmacao::getListaConfirmacao();

		$page = new Page();

		$page->setTpl("confirmar-apuracao", [
			"confirmarApuracao" => $confirmarApuracao
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

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {	
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

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
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

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {	
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

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
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

		//Verificação para nao acessar paginas que ja passou 
		//pelo sistema para nao poder acessar novamente
		if (isset($confirmacaoDetalhe[0]['status']) && $confirmacaoDetalhe[0]['status'] == 2) {
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
});

?>