<?php 

session_start();

date_default_timezone_set('America/Sao_Paulo');

require_once("vendor/autoload.php");

use \Slim\Slim;

$app = new \Slim\Slim();

$app->config("debug", true);

//Chamando as rotas
//Exemplo: require_once("functions.php");
 
require_once("Route/site/site.php");

$app->run();

 ?>