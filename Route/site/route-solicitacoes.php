<?php 

use \App\Config\Page;

$app->get('/solicitacoes', function(){

	$page = new Page();

	$page->setTpl("solicitacoes");

});

$app->get('/ler-solicitacao', function(){

	$page = new Page();

	$page->setTpl("ler-solicitacao");

});

$app->get('/nova-solicitacao', function(){

	$page = new Page();

	$page->setTpl("nova-solicitacao");

});

$app->get('/solicitacoes-enviadas', function(){

	$page = new Page();

	$page->setTpl("solicitacoes-enviadas");

});

$app->get('/solicitacoes-lixeira', function(){

	$page = new Page();

	$page->setTpl("solicitacoes-lixeira");

});

?>