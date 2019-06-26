<?php 

use \App\Config\Page;

$app->get("/criar-apuracao-etapa1", function(){
	
	$page = new Page();

	$page->setTpl("criar-apuracao-etapa1");
});

?>