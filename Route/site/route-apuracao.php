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

$app->get("/confirmar-apuracao", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("confirmar-apuracao");
});

$app->get("/confirmar-apuracao-detalhe", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("confirmar-apuracao-detalhe");
});

?>