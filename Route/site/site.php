<?php

use \App\Config\Page;

$app->get("/", function(){

	$page = new Page();

	$page->setTpl("inicio");

});

$app->get("/criar-ocorrencia", function(){

	$page = new Page();

	$page->setTpl("criar-ocorrencia");

});

?>