<?php
use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;
use \App\Model\MVitima;
use \App\Model\MResponsavel;

//instaciando
$mocorrencia = new MOcorrencia;
$marquivo = new MArquivo;
$validacao = new Validacao;
$mvitima = new MVitima;
$mpessoa = new MResponsavel;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

$listaVitima = $mvitima->vitimaEspecificaVitimasApuracao($idVitima);

$listaResponsavel = $mresponsavel->responsavelEspecifico($idResponsavelApuracao);

//HTML DO RELATORIO
$pagina = 

"
<!DOCTYPE html>
<html>
<head>
    <title>Documento</title>
    <meta charset='utf-8'>

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
            
        foreach ($listaResponsavel as $value) {

            $pagina .= "<p>O(a) responsável foi excluido, tal qual apresenta-se 
            pelo nome ".utf8_encode($value['nome']).", sendo";

            if ($value['isPais'] == '1') {
                $pagina .= " pai ";
            }

            if ($value['isPais'] == '2') {
                $pagina .= " mae ";
            }

            if ($value['isPais'] == '3') {
                $pagina .= " ".utf8_encode($value['outro'])." ";
            }

            $pagina .= "da vítima ".utf8_encode($listaVitima[0]['nome'])." com grau de parentesco. 
            Portador(a) do CPF ".$validacao->replaceCpfView($value['cpf']).", 
            RG ".$validacao->replaceRgView($value['rg']);

            $pagina .= ". Nascido(a) em ".$validacao->replaceDataView($value['dataNasc']);

            $pagina .= ", como consta em cartório, e assim possuindo o gênero";

            if ($value['sexo'] == 'm') {
                $pagina .= " masculino. ";
            }

            if ($value['sexo'] == 'f') {
                $pagina .= " feminino. ";
            }

            $pagina .= "O e-mail ".$value['email']." é um método de comunicação, ";

            $pagina .= "juntamente do telefone fixo ".$validacao->replaceTelefoneFixoView($value['fixo'])." ";

            $pagina .= "e número de celular ".$validacao->replaceCelularView($value['celular']).". ";

            $pagina .= "Reside no CEP ".$validacao->replaceCepView($value['cep']).", 
            conforme a Rua ".utf8_encode($value['rua']).", ";

            $pagina .= "do bairro ".utf8_encode($value['bairro']).", número ".$value['numero'].", ";

            $pagina .= "situado no Estado ".$value['estado'].", ";

            $pagina .= "na cidade ".utf8_encode($value['cidade']).", com 
            complemento ".utf8_encode($value['complemento']).".</p>";

        }

        $pagina .= "<p>O(a) responsável foi excluido(a) pelo seguinte motivo: ".$post['descricao']."</p>";

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