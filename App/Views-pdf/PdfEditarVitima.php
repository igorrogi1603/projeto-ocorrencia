<?php
use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;

//instaciando
$mocorrencia = new MOcorrencia;
$marquivo = new MArquivo;
$validacao = new Validacao;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

//INFORMACOES
$vitimaOcorrencia = $mocorrencia->listaOcorrenciaVitimaCompleta($idVitima, $idOcorrencia);

//Pega o tamanho do arry para usar no for
$tamanhoArray = count($vitimaOcorrencia);

//Validacao dos campos com acentos do banco de dados
for ($i = 0; $i < $tamanhoArray; $i++) {
    $vitimaOcorrencia[$i]['descricao'] = utf8_encode($vitimaOcorrencia[$i]['descricao']);
    $vitimaOcorrencia[$i]['tipoApuracao'] = utf8_encode($vitimaOcorrencia[$i]['tipoApuracao']);
    $vitimaOcorrencia[$i]['qualFamilia'] = utf8_encode($vitimaOcorrencia[$i]['qualFamilia']);
    $vitimaOcorrencia[$i]['nomeVitima'] = utf8_encode($vitimaOcorrencia[$i]['nomeVitima']);
    $vitimaOcorrencia[$i]['nomeResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['nomeResponsavel']);
    $vitimaOcorrencia[$i]['ruaVitima'] = utf8_encode($vitimaOcorrencia[$i]['ruaVitima']);
    $vitimaOcorrencia[$i]['bairroVitima'] = utf8_encode($vitimaOcorrencia[$i]['bairroVitima']);
    $vitimaOcorrencia[$i]['cidadeVitima'] = utf8_encode($vitimaOcorrencia[$i]['cidadeVitima']);
    $vitimaOcorrencia[$i]['estadoVitima'] = strtoupper(utf8_encode($vitimaOcorrencia[$i]['estadoVitima']));
    $vitimaOcorrencia[$i]['complementoVitima'] = utf8_encode($vitimaOcorrencia[$i]['complementoVitima']);
    $vitimaOcorrencia[$i]['ruaResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['ruaResponsavel']);
    $vitimaOcorrencia[$i]['bairroResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['bairroResponsavel']);
    $vitimaOcorrencia[$i]['cidadeResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['cidadeResponsavel']);
    $vitimaOcorrencia[$i]['estadoResponsavel'] = strtoupper(utf8_encode($vitimaOcorrencia[$i]['estadoResponsavel']));
    $vitimaOcorrencia[$i]['complementoResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['complementoResponsavel']);
    $vitimaOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($vitimaOcorrencia[$i]['cpfVitima']));
    $vitimaOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($vitimaOcorrencia[$i]['celularVitima']));
    $vitimaOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($vitimaOcorrencia[$i]['cpfResponsavel']));
    $vitimaOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($vitimaOcorrencia[$i]['celularResponsavel']));
    $vitimaOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($vitimaOcorrencia[$i]['cepVitima']));
    $vitimaOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($vitimaOcorrencia[$i]['cepResponsavel']));
    $vitimaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataRegistroOcorrencia']));
    $vitimaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataRegistroOcorrencia']));
    $vitimaOcorrencia[$i]['dataNascVitima'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataNascVitima']));
    $vitimaOcorrencia[$i]['quemCriouApuracao'] = utf8_encode($vitimaOcorrencia[$i]['quemCriouApuracao']);
    $vitimaOcorrencia[$i]['setor'] = utf8_encode($vitimaOcorrencia[$i]['setor']);

    if ($vitimaOcorrencia[$i]['sexoVitima'] == "m") {
        $vitimaOcorrencia[$i]['sexoVitima'] = "Masculino";
    }
    if ($vitimaOcorrencia[$i]['sexoVitima'] == "f") {
        $vitimaOcorrencia[$i]['sexoVitima'] = "Feminino";
    }
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

            for ($i = 0; $i < 1; $i++) {
                $pagina .= "<p>A vítima foi editada, tal qual apresenta-se pelo nome ".$vitimaOcorrencia[$i]['nomeVitima']." 
                do sexo ".$vitimaOcorrencia[$i]['sexoVitima']." Nascido em ".$vitimaOcorrencia[$i]['dataNascVitima']."
                portador(a) do CPF: ".$vitimaOcorrencia[$i]['cpfVitima'].", RG ".$vitimaOcorrencia[$i]['rgVitima'].", 
                do celular ".$vitimaOcorrencia[$i]['celularVitima'].", do fixo ".$vitimaOcorrencia[$i]['fixoVitima']."
                e do e-mail ".$vitimaOcorrencia[$i]['emailVitima'].".
                A vítima se localiza no CEP: ".$vitimaOcorrencia[$i]['cepVitima']."
                , rua ".$vitimaOcorrencia[$i]['ruaVitima'].", bairro ".$vitimaOcorrencia[$i]['bairroVitima'].", numero 
                ".$vitimaOcorrencia[$i]['numeroVitima'].", estado ".$vitimaOcorrencia[$i]['estadoVitima']." e cidade de 
                ".$vitimaOcorrencia[$i]['cidadeVitima']."</p>";
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