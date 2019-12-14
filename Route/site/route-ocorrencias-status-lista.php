<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CListaOcorrencia;

//QUATRO FASES DA OCORRENCIA
$app->get("/ocorrencias-abertas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

		$page = new Page();

		$page->setTpl("ocorrencias-abertas", [
			"listaOcorrencia" => $listaOcorrencia
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-reabertas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

		$page = new Page();

		$page->setTpl("ocorrencias-reabertas", [
			"listaOcorrencia" => $listaOcorrencia
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-arquivadas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

		$page = new Page();

		$page->setTpl("ocorrencias-arquivadas", [
			"listaOcorrencia" => $listaOcorrencia
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-encerradas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

		$page = new Page();

		$page->setTpl("ocorrencias-encerradas", [
			"listaOcorrencia" => $listaOcorrencia
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

?>