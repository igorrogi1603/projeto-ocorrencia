<?php

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CLogin;
use \App\Config\Page;

$app->get("/", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("inicio");
});

?>