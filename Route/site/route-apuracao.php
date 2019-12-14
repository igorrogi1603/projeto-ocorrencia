<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;
use \App\Controller\CListaApuracao;

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

		$page = new Page();

		$page->setTpl("lista-apuracoes", [
			"listaApuracao" => $listaApuracao
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

		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
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

		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
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
		
		if (isset($detalheApuracao[0]['status']) && $detalheApuracao[0]['status'] == 1) {
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
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

?>