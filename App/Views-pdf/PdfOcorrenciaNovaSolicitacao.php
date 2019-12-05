<?php
use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;
use \App\Model\MUsuario;
use \App\Model\MPessoa;
use \App\Model\MInstituicao;
use \App\Model\MVitima;

//instaciando
$mocorrencia = new MOcorrencia;
$marquivo = new MArquivo;
$validacao = new Validacao;
$musuario = new MUsuario;
$mpessoa = new MPessoa;
$minstituicao = new MInstituicao;
$mvitima = new MVitima;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

//Recuperando o id do usuario
$listaUsuario = $musuario->usuarioEspecifico($post['para']);

//Descobrir se o usuario e instituicao ou pessoa fisica
foreach ($listaUsuario as $value) {
    
    if (isset($value['idPessoa']) && $value['idPessoa'] != null && $value['idPessoa'] != "") {

        $nomePdfPara = $mpessoa->pessoaEspecifica($value['idPessoa']);
    }

    if (isset($value['idInstituicao']) && $value['idInstituicao'] != null && $value['idInstituicao'] != "") {

        $nomePdfPara = $minstituicao->InstituicaoEspecifica($value['idInstituicao']);
    }
}//fim foreache descobrir usuario

$listaVitima = $mvitima->vitimaEspecificaVitimasApuracao($post['vitima']);

//HTML DO RELATORIO
$pagina = 

"
<!DOCTYPE html>
<html>
<head>
    <title>Documento</title>

    <style>

    html, body {
        height: 100%;
        width: 100%;
        font-family: 'Arial', Helvetica, sans-serif;
        font-size: 12px;
    }

    .container-total {
        margin-left: 1.5cm;
        margin-top: 2cm;
        margin-bottom: 2cm;
        margin-right: 1.5cm;
    }

    .cabecalho {
        width: 100%;
        height: 100px;
    }

    .pos-cabecalho {
        width: 100%;
        height: 70px;
        text-align: center;
        line-height: 50px;
        font-weight: bold;
    }

    .antes-conteudo {
        width: 100%;
        height: 80px;
        line-height: 80px;
    }

    .oficio {
        float: left;
        width: 50%;
        text-align: left;
    }

    .data {
        float: right;
        width: 50%;
        text-align: right;
    }

    .conteudo {
        text-align: justify;
    }

    .dedicatoria {
        width: 100%;
        height: 80px;
        line-height: 80px;
        text-align: center;
    }

    .assinatura {
        width: 100%;
        height: 80px;
        line-height: 80px;
        text-align: center;
    }

    .assinatura .linha {
        display: block;
    }

    .assinatura .nome {
        margin-top: -60px;
        font-weight: bold;
        display: block;
    }

    .assinatura .setor {
        margin-top: -60px;
        display: block;
    }

    .rodape {
        position: absolute;
        bottom: 0;
        left: 0;
        margin-bottom: 5px;
        width: 100%;
        text-align: center;
    }

    . sem-espacamento {
        margin: 0px;
        padding: 0px;
    }

    </style>
</head>
<body>

    <div class='container-total'>
        
        <div class='cabecalho'>
            Logo
        </div>";

        if (isset($_SESSION['User']['setor']) && $_SESSION['User']['setor'] != "" && $_SESSION['User']['setor'] != null) {
            $pagina .= "<div class='pos-cabecalho'>
                ".utf8_encode($_SESSION['User']['setor'])."
            </div>";
        } else {
            $pagina .= "<div class='pos-cabecalho'>
                ".utf8_encode($_SESSION['User']['nome'])."
            </div>";
        }

        $pagina .= "<div class='antes-conteudo'>
            <div class='oficio'><p>Oficio ".$idArquivoNovo."/".date('Y')."</p></div>
            <div class='data'><p>Nova Campina, ".date('d')." de ".date('M')." de ".date('Y')."</p></div>
        </div>

        <div class='conteudo'>";

        $pagina .= "<p>Nova solicitação criada por ".utf8_encode($_SESSION['User']['nome']).", 
        foi direcionada para ".utf8_encode($nomePdfPara[0]['nome']).", 
        onde a vítima é ".utf8_encode($listaVitima[0]['nome']).", 
        com assunto: ".$post['assunto']." 
        e mensagem: ".$post['mensagem']."</p>";

        $pagina .= "</div>

    </div>

    <div class='rodape'>
        <hr class='sem-espacamento'>
        <p class='sem-espacamento'>Assinado digitalmente por <strong>".utf8_encode($_SESSION['User']['nome'])."</strong></p>
    </div>

</body>
</html>
";

?>