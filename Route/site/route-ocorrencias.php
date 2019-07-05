<?php 

use \App\Config\Page;

$app->get("/ocorrencia-enviada", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-enviada");
});

$app->post("/ocorrencia-enviada", function(){

	header('Location: /ocorrencia-enviada');
    exit;
});

$app->get("/ocorrencia-enviada-print", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/ocorrencia-enviada-print");	
});

$app->get("/ocorrencias-abertas", function(){

	$page = new Page();

	$page->setTpl("ocorrencias-abertas");
});

$app->get("/ocorrencias-reabertas", function(){

	$page = new Page();

	$page->setTpl("ocorrencias-reabertas");
});

$app->get("/ocorrencias-arquivadas", function(){

	$page = new Page();

	$page->setTpl("ocorrencias-arquivadas");
});

$app->get("/ocorrencias-encerradas", function(){

	$page = new Page();

	$page->setTpl("ocorrencias-encerradas");
});


/*Detalhes da Ocorrencia*/
$app->get("/ocorrencia-detalhe", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-detalhe");
});

$app->get("/ocorrencia-relatorio", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-relatorio");
});

$app->get("/ocorrencia-relatorio-print", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("ocorrencia-relatorio-print");	
});

$app->get("/ocorrencia-arquivos", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-arquivos");
});

$app->get("/ocorrencia-solicitacao", function(){

	$page = new Page();

	$page->setTpl("ocorrencia-solicitacao");
});
?>