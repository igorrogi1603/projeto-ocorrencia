<?php 

use \App\Classe\Usuario;
use \App\Config\Page;
use \App\Controller\CNotificacao;

$app->get('/excluir-notificacao/:idNotificacao/:url', function($idNotificacao ,$url){

	Usuario::verifyLogin();

	CNotificacao::getExcluirNotificacao($idNotificacao);

	$url = str_replace("!!", "/", $url);

	header("Location: ".$url);
	exit;

});

?>