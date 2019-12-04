<?php
use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;
use \App\Model\MAgressor;
use \App\Model\MInstituicao;

//instaciando
$mocorrencia = new MOcorrencia;
$marquivo = new MArquivo;
$validacao = new Validacao;
$magressor = new MAgressor;
$minstituicao = new MInstituicao;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

//Pessoa Fisica
if ($isInstituicao == 0) {
    $listaAgressor = $magressor->listaAgressorEspecifico($idOcorrencia, $idOcorrenciaAgressor);
}

if ($isInstituicao == 1) {
    $listaInstituicao = $minstituicao->listaInstituicaoEspecifica($idOcorrencia, $idOcorrenciaAgressor);
}

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

        //Instituicao
        if ($isInstituicao == 1) {

            foreach ($listaInstituicao as $value) {

            $pagina .= "<p>O(a) agressor(a) EXCLUIDO é um(A) INSTITUIÇÃO, tida pelo  
            nome ".utf8_encode($value['nome']).", ";

            $pagina .= "portador(a) do CNPJ ".$value['cnpj'].". ";

            $pagina .= "O e-mail ".$value['email']." é um método de comunicação, juntamente do telefone 
            fixo ".$value['fixo']." e número de celular ".$value['celular'].". 
            Reside no CEP ".$value['cep'].", conforme a Rua ".utf8_encode($value['rua']).", do 
            bairro ".utf8_encode($value['bairro']).", número ".$value['numero'].", situado no 
            Estado ".$value['estado'].", na cidade ".utf8_encode($value['cidade']).", com 
            complemento ".utf8_encode($value['complemento']).".</p>";

            }
        }

        //pessoa fisica
        if ($isInstituicao == 0) {

            foreach ($listaAgressor as $value) {

            $pagina .= "<p>O(a) agressor(a) EXCLUIDO é um (a) PESSOA FÍSICA, apresentando-se pelo 
            nome ".utf8_encode($value['nome']).", ";

            $pagina .= "portador(a) do CPF ".$value['cpf'].", 
            RG ".$validacao->replaceRgView($value['rg']);

            $pagina .= ". Nascido(a) em ".$validacao->replaceDataView($value['dataNasc']);

            $pagina .= ", como consta em cartório, e assim possuindo o gênero";

            if ($value['sexo'] == 'm') {
                $pagina .= " masculino. ";
            }

            if ($value['sexo'] == 'f') {
                $pagina .= " feminino. ";
            }

            $pagina .= "O e-mail ".$value['email']." é um método de comunicação, juntamente do telefone 
            fixo ".$value['fixo']." e número de celular ".$value['celular'].". 
            Reside no CEP ".$value['cep'].", conforme a Rua ".utf8_encode($value['rua']).", do 
            bairro ".utf8_encode($value['bairro']).", número ".utf8_encode($value['numero']).", situado no 
            Estado ".$value['estado'].", na cidade ".utf8_encode($value['cidade']).", com 
            complemento ".utf8_encode($value['complemento']).".</p>";

            }
        }

        $pagina .= "<p>O(a) agressor(a) foi excluido(a) pelo seguinte motivo: ".$post['descricaoAgressor']."</p>";

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