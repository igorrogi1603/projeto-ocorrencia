<?php 

use \App\Classe\Usuario;
use \App\Config\Page;

$app->get('/solicitacoes', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("solicitacoes");

});

$app->get('/ler-solicitacao', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ler-solicitacao");

});

$app->get('/nova-solicitacao', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("nova-solicitacao");

});

$app->get('/solicitacoes-enviadas', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("solicitacoes-enviadas");

});

$app->get('/solicitacoes-lixeira', function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("solicitacoes-lixeira");

});

?>