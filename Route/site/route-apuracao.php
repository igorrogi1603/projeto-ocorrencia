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

	$page = new Page();

	$page->setTpl("apuracao-enviada", [
		"apuracaoCompleta" => $apuracaoCompleta
	]);
});

$app->get("/apuracao-enviada-print/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();
	
	$apuracaoCompleta = CCriarApuracao::getApuracaoEnviada($idApuracao);
	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("apuracao-enviada-print", [
		"apuracaoCompleta" => $apuracaoCompleta
	]);
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

	$page = new Page();

	$page->setTpl("apuracao-detalhe", [
		"detalheApuracao" => $detalheApuracao
	]);
});

$app->get("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("apuracao-descartar", [
		"idApuracao" => $idApuracao
	]);
});

$app->post("/apuracao-detalhe/descartar/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

	header("Location: /lista-apuracoes");
	exit;
});

$app->get("/apuracao-detalhe/gerar-ocorrencia/:idApuracao", function($idApuracao){

	Usuario::verifyLogin();

	CListaApuracao::getGerarOcorrencia($idApuracao);

	header("Location: /confirmar-apuracao");
	exit;
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

	$page = new Page();

	$page->setTpl("confirmar-apuracao-detalhe", [
		"confirmacaoDetalhe" => $confirmacaoDetalhe,
		"error" => Validacao::getMsgError()
	]);
});

$app->get("/confirmacao-positivo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	CListaConfirmacao::getConfirmacaoPositivo($idApuracao, $idConfirmacao);

	header('Location: /ocorrencias-abertas');
	exit;
});

$app->get("/confirmacao-negativo/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	CListaConfirmacao::getConfirmacaoNegativo($idApuracao, $idConfirmacao);

	header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
	exit;
});

$app->get("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("confirmacao-descartar", [
		"idApuracao" => $idApuracao,
		"idConfirmacao" => $idConfirmacao
	]);
});

$app->get("/confirmacao-detalhe/cancelar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	CListaConfirmacao::confirmacaoDetalheCancelar($idConfirmacao);

	header("Location: /confirmar-apuracao");
	exit;
});

$app->post("/confirmacao-detalhe/descartar/:idApuracao/:idConfirmacao", function($idApuracao, $idConfirmacao){

	Usuario::verifyLogin();

	CListaApuracao::postDescartarApuracao($_POST, $idApuracao);

	header("Location: /confirmar-apuracao");
	exit;
});


?>