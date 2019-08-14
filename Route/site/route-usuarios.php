<?php 

use \App\Config\Page;

$app->get('/usuarios-cadastrar', function(){

	$page = new Page();

	$page->setTpl("usuarios-cadastrar");

});

$app->get('/usuarios-lista', function(){

	$page = new Page();

	$page->setTpl("usuarios-lista");

});

?>