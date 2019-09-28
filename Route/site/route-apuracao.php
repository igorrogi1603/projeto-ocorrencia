<?php 

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Config\Page;
use \App\Controller\CCriarApuracao;
use \App\Controller\CListaApuracao;
use \App\Controller\CListaConfirmacao;

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

$app->get("/lista-apuracoes", function(){

	Usuario::verifyLogin();
	
	$listaApuracao = CListaApuracao::getListaApuracao();

	$page = new Page();

	$page->setTpl("lista-apuracoes", [
		"listaApuracao" => $listaApuracao
	]);
});

$app->get("/apuracao-detalhe/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente
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
});

$app->get("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente
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
});

$app->post("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

	header("Location: /lista-apuracoes");
	exit;
});

$app->get("/apuracao-detalhe/gerar-ocorrencia/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	$detalheApuracao = CListaApuracao::getApuracaoDetalhe($idApuracao);

	//Verificação para nao acessar paginas que ja passou 
	//pelo sistema para nao poder acessar novamente
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
});

$app->get("/confirmar-apuracao", function(){

	Usuario::verifyLogin();

	$confirmarApuracao = CListaConfirmacao::getListaConfirmacao();

	$page = new Page();

	$page->setTpl("confirmar-apuracao", [
		"confirmarApuracao" => $confirmarApuracao
	]);
});

$app->get("/confirmar-apuracao-detalhe/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

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
});

$app->get("/confirmacao-positivo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

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
});

$app->get("/confirmacao-negativo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

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
});

$app->get("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

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
});

$app->get("/confirmacao-detalhe/cancelar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

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
});

$app->post("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

	header("Location: /confirmar-apuracao");
	exit;
});


?>