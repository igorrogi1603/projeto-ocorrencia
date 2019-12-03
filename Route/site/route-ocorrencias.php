<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CListaOcorrencia;
use \App\Controller\CDetalheOcorrencia;
use \App\Controller\COcorrenciaVitima;
use \App\Controller\COcorrenciaResponsavel;
use \App\Controller\COcorrenciaEnviarArquivo;
use \App\Controller\COcorrenciaAcompanhamento;
use \App\Controller\COcorrenciaAgressorCadastrar;
use \App\Controller\COcorrenciaAgressor;
use \App\Controller\COcorrenciaAgressorEnviarArquivo;
use \App\Controller\COcorrenciaDescricao;
use \App\Controller\COcorrenciaNovaSolicitacao;
use \App\Controller\COcorrenciaSolicitacao;
use \App\Controller\COcorrenciaStatus;
use \App\Controller\COcorrenciaArquivos;

//QUATRO FASES DA OCORRENCIA
$app->get("/ocorrencias-abertas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-abertas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-reabertas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-reabertas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-arquivadas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-arquivadas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

$app->get("/ocorrencias-encerradas", function(){

	Usuario::verifyLogin();

	$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();

	$page = new Page();

	$page->setTpl("ocorrencias-encerradas", [
		"listaOcorrencia" => $listaOcorrencia
	]);
});

//--------------------------------------------------------------

/*Detalhes da Ocorrencia*/
$app->get("/ocorrencia-detalhe/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();
	
	$detalheOcorrencia = CDetalheOcorrencia::getOcorrenciaDetalhe($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-detalhe", [
		"detalheOcorrencia" => $detalheOcorrencia
	]);
});

//Dentro da pagina detalhes
//--------------------------------------------------------------
//Vitimas
$app->get("/ocorrencia-vitimas-lista/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$vitimas = COcorrenciaVitima::getOcorrenciaVitimasLista($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitimas-lista", [
		"vitimas" => $vitimas
	]);
});

$app->get("/ocorrencia-vitimas/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::getOcorrenciaVitima($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitimas", [
		"vitima" => $vitima,
		"idVitima" => $idVitima
	]);
});

$app->get("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::getOcorrenciaVitimaEditar($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-editar", [
		"vitima" => $vitima,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-vitima-editar/:idVitima/:idOcorrencia/:idPessoa", function($idVitima, $idOcorrencia, $idPessoa){

	Usuario::verifyLogin();

	$vitima = COcorrenciaVitima::postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $_POST);

	header("Location: /ocorrencia-vitimas/".$idVitima."/".$idOcorrencia);
	exit;
});

//RESPONSAVEL PELA VITIMA
$app->get("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-cadastrar", [
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-responsavel-vitima-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaResponsavel::postCadastrarResponsavelVitima($idVitima, $idOcorrencia, $_POST);

	header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-responsavel-vitima-detalhe/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	$responsavel = COcorrenciaResponsavel::getDetalheResponsavelVitima($idPessoaResponsavel);

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-detalhe", [
		"responsavel" => $responsavel,
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia
	]);
});

$app->get("/ocorrencia-responsavel-vitima-lista/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$responsavel = COcorrenciaResponsavel::getListaResponsavelVitima($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-lista", [
		"responsavel" => $responsavel,
		"error"=>Validacao::getMsgError()
	]);
});

$app->get("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	$responsavel = COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel);

	$page = new Page();

	$page->setTpl("ocorrencia-responsavel-vitima-editar", [
		"responsavel" => $responsavel,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-responsavel-vitima-editar/:idVitima/:idOcorrencia/:idPessoaResponsavel", function($idVitima, $idOcorrencia, $idPessoaResponsavel){

	Usuario::verifyLogin();

	COcorrenciaResponsavel::postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel, $_POST);

	header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-responsavel-vitima-excluir/:idVitima/:idOcorrencia/:idPessoaResponsavel/:idResponsavelApuracao/:idCriarApuracao", function($idVitima, $idOcorrencia, $idPessoaResponsavel, $idResponsavelApuracao, $idCriarApuracao){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("responsavel-descartar", [
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"idPessoaResponsavel" => $idPessoaResponsavel,
		"idResponsavelApuracao" => $idResponsavelApuracao,
		"idCriarApuracao" => $idCriarApuracao
	]);
});

$app->post("/ocorrencia-responsavel-vitima-excluir/:idVitima/:idOcorrencia/:idPessoaResponsavel/:idResponsavelApuracao/:idCriarApuracao", function($idVitima, $idOcorrencia, $idPessoaResponsavel, $idResponsavelApuracao, $idCriarApuracao){

	Usuario::verifyLogin();

	COcorrenciaResponsavel::getOcorrenciaResponsavelVitimaExcluir($idResponsavelApuracao, $_POST, $idCriarApuracao, $idOcorrencia, $idVitima, $idPessoaResponsavel);

	header("Location: /ocorrencia-responsavel-vitima-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-vitima-enviar-arquivo-lista/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$documento = COcorrenciaEnviarArquivo::getEnviarArquivoLista($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-enviar-arquivo-lista", [
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"documento" => $documento
	]);
});

$app->get("/ocorrencia-vitima-enviar-arquivo-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$dados = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrar($idVitima, $idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar", [
		"selecionaPessoa" => $dados,
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-vitima-enviar-arquivo-cadastrar/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
	if($_FILES["upDocumento"]["name"] !== ""){
		COcorrenciaEnviarArquivo::postEnviarArquivoCadastrar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia);
	} else {
		Validacao::setMsgError("Selecione um arquivo PDF");
        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
        exit;
	}

	header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar/:idVitima/:idOcorrencia/:idArquivo/:idPessoa", function($idVitima, $idOcorrencia, $idArquivo, $idPessoa){

	Usuario::verifyLogin();

	$dados = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrarAtualizar($idVitima, $idOcorrencia, $idPessoa);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar", [
		"selecionaPessoa" => $dados,
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia,
		"idArquivo" => $idArquivo,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-vitima-enviar-arquivo-cadastrar-atualizar/:idVitima/:idOcorrencia/:idArquivo", function($idVitima, $idOcorrencia, $idArquivo){

	Usuario::verifyLogin();

	//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
	if($_FILES["upDocumento"]["name"] !== ""){
		COcorrenciaEnviarArquivo::postEnviarArquivoCadastrarAtualizar($_FILES["upDocumento"], $_POST, $idVitima, $idOcorrencia, $idArquivo);
	} else {
		Validacao::setMsgError("Selecione um arquivo PDF");
        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
        exit;
	}

	header("Location: /ocorrencia-vitima-enviar-arquivo-lista/".$idVitima."/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-vitima-acompanhamento/:idVitima/:idOcorrencia", function($idVitima, $idOcorrencia){

	Usuario::verifyLogin();

	$acompanhamento = COcorrenciaAcompanhamento::getOcorrenciaAcompanhamento($idVitima);

	$page = new Page();

	$page->setTpl("ocorrencia-vitima-acompanhamento", [
		"acompanhamento" => $acompanhamento,
		"idVitima" => $idVitima,
		"idOcorrencia" => $idOcorrencia
	]);
});

//--------------------------------------------------------------

$app->get("/ocorrencia-agressor/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressor::getListaAgressor($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-agressor", [
		"idOcorrencia" => $idOcorrencia,
		"agressor" => $listaAgressor
	]);
});

$app->get("/ocorrencia-agressor-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-agressor-cadastrar", [
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-agressor-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaAgressorCadastrar::postAgressorCadastrar($idOcorrencia, $_POST);

	header("Location: /ocorrencia-agressor/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-agressor-detalhe/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressor::getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

	$page = new Page();

	$page->setTpl("ocorrencia-agressor-detalhe", [
		"idOcorrencia" => $idOcorrencia,
		"isInstituicao" => $isInstituicao,
		"agressor" => $listaAgressor
	]);
});

$app->get("/ocorrencia-agressor-editar/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressor::getAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

	//Operador ternario -> decidir qual template vai ser carregado
	$template = $isInstituicao == 0 ? "ocorrencia-agressor-editar" : "ocorrencia-instituicao-editar";

	$page = new Page();

	$page->setTpl($template, [
		"idOcorrencia" => $idOcorrencia,
		"isInstituicao" => $isInstituicao,
		"agressor" => $listaAgressor,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-agressor-editar/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	COcorrenciaAgressor::postAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $_POST);

	header("Location: /ocorrencia-agressor/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-agressor-excluir/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressor::getAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

	$page = new Page();

	$page->setTpl("agressor-descartar", [
		"idOcorrencia" => $idOcorrencia,
		"isInstituicao" => $isInstituicao,
		"agressor" => $listaAgressor,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-agressor-excluir/:idOcorrencia/:isInstituicao/:idOcorrenciaAgressor/:idAgressor", function($idOcorrencia, $isInstituicao, $idOcorrenciaAgressor, $idAgressor){

	Usuario::verifyLogin();

	COcorrenciaAgressor::postAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $idAgressor, $_POST);

	header("Location: /ocorrencia-agressor/".$idOcorrencia);
	exit;
});

//Enviar Arquivo Agressor
$app->get("/ocorrencia-agressor-enviar-arquivo/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$documento = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoLista($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-agressor-enviar-arquivo", [
		"idOcorrencia" => $idOcorrencia,
		"documento" => $documento
	]);
});

$app->get("/ocorrencia-agressor-enviar-arquivo-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrar($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-agressor-enviar-arquivo-cadastrar", [
		"selecionaPessoa" => $listaAgressor,
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-agressor-enviar-arquivo-cadastrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
	if($_FILES["upDocumento"]["name"] !== ""){
		COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrar($idOcorrencia, $_POST, $_FILES["upDocumento"]);
	} else {
		Validacao::setMsgError("Selecione um arquivo PDF");
        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
        exit;
	}

	header("Location: /ocorrencia-agressor-enviar-arquivo/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/:idOcorrencia/:idPessoa/:idArquivo", function($idOcorrencia, $idPessoa, $idArquivo){

	Usuario::verifyLogin();

	$listaAgressor = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrarAtualizar($idOcorrencia, $idPessoa);

	$page = new Page();

	$page->setTpl("ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar", [
		"selecionaPessoa" => $listaAgressor,
		"idOcorrencia" => $idOcorrencia,
		"idArquivo" => $idArquivo,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-agressor-enviar-arquivo-cadastrar-atualizar/:idOcorrencia/:idArquivo", function($idOcorrencia, $idArquivo){

	Usuario::verifyLogin();

	//if serve para nao dar erro na variavel sendo passada como parametro caso ela nao exista dará erro
	if($_FILES["upDocumento"]["name"] !== ""){
		COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrarAtualizar($idOcorrencia, $_POST, $_FILES["upDocumento"], $idArquivo);
	} else {
		Validacao::setMsgError("Selecione um arquivo PDF");
        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
        exit;
	}

	header("Location: /ocorrencia-agressor-enviar-arquivo/".$idOcorrencia);
	exit;
});

//--------------------------------------------------------------
//Ocorrencia detalhe
$app->get("/ocorrencia-descricao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$listaDescricao = COcorrenciaDescricao::getOcorrenciaDescricao($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-descricao", [
		"descricao" => $listaDescricao,
		"idOcorrencia" => $idOcorrencia
	]);
});

$app->get("/ocorrencia-descricao-editar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$listaDescricao = COcorrenciaDescricao::getOcorrenciaDescricao($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-descricao-editar", [
		"descricao" => $listaDescricao,
		"idOcorrencia" => $idOcorrencia,
		"error"=>Validacao::getMsgError()
	]);
});

$app->post("/ocorrencia-descricao-editar/:idOcorrencia/:idApuracao", function($idOcorrencia, $idApuracao){

	Usuario::verifyLogin();

	COcorrenciaDescricao::postOcorrenciaDescricaoEditar($idOcorrencia, $idApuracao, $_POST);

	header("Location: /ocorrencia-descricao/".$idOcorrencia);
	exit;
});


//--------------------------------------------------------------

$app->get("/ocorrencia-relatorio", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-relatorio");
});

$app->get("/ocorrencia-relatorio-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("ocorrencia-relatorio-print");	
});

$app->get("/ocorrencia-arquivos/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$listaArquivos = COcorrenciaArquivos::getArquivos($idOcorrencia);

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("ocorrencia-arquivos", [
		"arquivos" => $listaArquivos
	]);
});

//--------------------------------------------------------------

$app->get("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	$page = new Page();

	$page->setTpl("ocorrencia-enviada");
});

$app->post("/ocorrencia-enviada", function(){

	Usuario::verifyLogin();

	header('Location: /ocorrencia-enviada');
    exit;
});

$app->get("/ocorrencia-enviada-print", function(){

	Usuario::verifyLogin();

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/ocorrencia-enviada-print");	
});

//--------------------------------------------------------------

$app->get("/ocorrencia-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$lista = COcorrenciaSolicitacao::getListaSolicitacao($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-solicitacao", [
		"idOcorrencia" => $idOcorrencia,
		"mensagem" => $lista
	]);
});

$app->get("/ocorrencia-nova-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	$usuarios = COcorrenciaNovaSolicitacao::getNovaSolicitacaoUsuario();
	$vitima = COcorrenciaNovaSolicitacao::getNovaSolicitacaoVitima($idOcorrencia);

	$page = new Page();

	$page->setTpl("ocorrencia-nova-solicitacao", [
		"usuarios" => $usuarios,
		"vitima" => $vitima,
		"idOcorrencia" => $idOcorrencia
	]);
});

$app->post("/ocorrencia-nova-solicitacao/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaNovaSolicitacao::postNovaSolicitacao($_POST, $idOcorrencia);

	header("Location: /ocorrencia-solicitacao/".$idOcorrencia);
	exit;
});

$app->get("/ocorrencia-ler-solicitacao/:idOcorrencia/:idSolicitacao/:isInstituicao", function($idOcorrencia, $idSolicitacao, $isInstituicao){

	Usuario::verifyLogin();

	$lista = COcorrenciaSolicitacao::getlerSolicitacao($idOcorrencia, $idSolicitacao, $isInstituicao);

	$page = new Page();

	$page->setTpl("ocorrencia-ler-solicitacao", [
		"idOcorrencia" => $idOcorrencia, 
		"mensagem" => $lista
	]);
});

//-----------------------------------------------------------------
//Status da ocorrencia
$app->get("/ocorrencia-detalhe/arquivar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaStatus::getArquivar($idOcorrencia);

	header("Location: /ocorrencias-arquivadas");
	exit;
});

$app->get("/ocorrencia-detalhe/encerrar/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaStatus::getEncerrar($idOcorrencia);

	header("Location: /ocorrencias-encerradas");
	exit;
});

$app->get("/ocorrencia-detalhe/reabrir/:idOcorrencia", function($idOcorrencia){

	Usuario::verifyLogin();

	COcorrenciaStatus::getReabrir($idOcorrencia);

	header("Location: /ocorrencias-reabertas");
	exit;
});


?>