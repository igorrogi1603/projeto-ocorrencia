<?php
use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;
use \App\Model\MAgressor;

//instaciando
$mocorrencia = new MOcorrencia;
$marquivo = new MArquivo;
$validacao = new Validacao;
$magressor = new MAgressor;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

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
        </div>

        <div class='pos-cabecalho'>
            ".utf8_encode($_SESSION['User']['setor'])."
        </div>

        <div class='antes-conteudo'>
            <div class='oficio'><p>Oficio ".$idArquivoNovo."/".date('Y')."</p></div>
            <div class='data'><p>Nova Campina, ".date('d')." de ".date('M')." de ".date('Y')."</p></div>
        </div>

        <div class='conteudo'>";

        if ($post['agressorRadio'] == 1) {

            $pagina .= "<p>O agressor é um (A) INSTITUIÇÃO, tida pelo  
            nome ".$post['nomeInstituicao'].", ";

            $pagina .= "portador(a) do CNPJ ".$post['cnpjInstituicao'].". ";

            $pagina .= "O e-mail ".$post['emailInstituicao']." é um método de comunicação, juntamente do telefone 
            fixo ".$post['telFixoInstituicao']." e número de celular ".$post['celularInstituicao'].". 
            Reside no CEP ".$post['cepInstituicao'].", conforme a Rua ".$post['ruaInstituicao'].", do 
            bairro ".$post['bairroInstituicao'].", número ".$post['numeroInstituicao'].", situado no 
            Estado ".$post['estadoInstituicao'].", na cidade ".$post['cidadeInstituicao'].", com 
            complemento ".$post['complementoInstituicao'].".</p>";
        }

        if ($post['agressorRadio'] == 2) {

            $pagina .= "<p>O(a) agressor(a) é um (a) PESSOA FÍSICA, apresentando-se pelo 
            nome ".$post['nomeAgressor'].", ";

            $rgAgressorView = $validacao->replaceRgBd($post['rgAgressor'], $post['rgDigitoAgressor']);

            $pagina .= "portador(a) do CPF ".$post['cpfAgressor'].", 
            RG ".$validacao->replaceRgView($rgAgressorView);

            $pagina .= ". Nascido(a) em ".$validacao->replaceDataView($post['dataNascAgressor']);

            $pagina .= ", como consta em cartório, e assim possuindo o gênero";

            if ($post['sexoAgressor'] == 'm') {
                $pagina .= " masculino. ";
            }

            if ($post['sexoAgressor'] == 'f') {
                $pagina .= " feminino. ";
            }

            $pagina .= "O e-mail ".$post['emailAgressor']." é um método de comunicação, juntamente do telefone 
            fixo ".$post['telFixoAgressor']." e número de celular ".$post['celularAgressor'].". 
            Reside no CEP ".$post['cepAgressor'].", conforme a Rua ".$post['ruaAgressor'].", do 
            bairro ".$post['bairroAgressor'].", número ".$post['numeroAgressor'].", situado no 
            Estado ".$post['estadoAgressor'].", na cidade ".$post['cidadeAgressor'].", com 
            complemento ".$post['complementoAgressor'].".</p>";
        }

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