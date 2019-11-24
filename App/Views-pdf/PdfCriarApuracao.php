<?php
use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;
use \App\Model\MArquivo;

//instaciando
$mapuracao = new MApuracao;
$marquivo = new MArquivo;
$validacao = new Validacao;

$idArquivo = $marquivo->ultimoRegistroArquivo();

$idArquivoNovo = (int)$idArquivo[0]['MAX(idArquivo)'] + 1;

//INFORMACOES
$detalheApuracao = $mapuracao->listApuracao($idApuracao);

//Pega o tamanho do arry para usar no for
$tamanhoArray = count($detalheApuracao);

//Validacao dos campos com acentos do banco de dados
for ($i = 0; $i < $tamanhoArray; $i++) {
    $detalheApuracao[$i]['descricao'] = utf8_encode($detalheApuracao[$i]['descricao']);
    $detalheApuracao[$i]['tipoApuracao'] = utf8_encode($detalheApuracao[$i]['tipoApuracao']);
    $detalheApuracao[$i]['qualFamilia'] = utf8_encode($detalheApuracao[$i]['qualFamilia']);
    $detalheApuracao[$i]['nomeVitima'] = utf8_encode($detalheApuracao[$i]['nomeVitima']);
    $detalheApuracao[$i]['nomeResponsavel'] = utf8_encode($detalheApuracao[$i]['nomeResponsavel']);
    $detalheApuracao[$i]['ruaVitima'] = utf8_encode($detalheApuracao[$i]['ruaVitima']);
    $detalheApuracao[$i]['bairroVitima'] = utf8_encode($detalheApuracao[$i]['bairroVitima']);
    $detalheApuracao[$i]['cidadeVitima'] = utf8_encode($detalheApuracao[$i]['cidadeVitima']);
    $detalheApuracao[$i]['estadoVitima'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoVitima']));
    $detalheApuracao[$i]['complementoVitima'] = utf8_encode($detalheApuracao[$i]['complementoVitima']);
    $detalheApuracao[$i]['ruaResponsavel'] = utf8_encode($detalheApuracao[$i]['ruaResponsavel']);
    $detalheApuracao[$i]['bairroResponsavel'] = utf8_encode($detalheApuracao[$i]['bairroResponsavel']);
    $detalheApuracao[$i]['cidadeResponsavel'] = utf8_encode($detalheApuracao[$i]['cidadeResponsavel']);
    $detalheApuracao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoResponsavel']));
    $detalheApuracao[$i]['complementoResponsavel'] = utf8_encode($detalheApuracao[$i]['complementoResponsavel']);
    $detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfVitima']));
    $detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularVitima']));
    $detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfResponsavel']));
    $detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularResponsavel']));
    $detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepVitima']));
    $detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepResponsavel']));
    $detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($detalheApuracao[$i]['dataRegistro']));
    $detalheApuracao[$i]['quemCriouApuracao'] = utf8_encode($detalheApuracao[$i]['quemCriouApuracao']);
    $detalheApuracao[$i]['setor'] = utf8_encode($detalheApuracao[$i]['setor']);
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
            ".$detalheApuracao[0]['setor']."
        </div>

        <div class='antes-conteudo'>
            <div class='oficio'><p>Oficio ".$idArquivoNovo."/".date('Y')."</p></div>
            <div class='data'><p>Nova Campina, ".date('d')." de ".date('M')." de ".date('Y')."</p></div>
        </div>

        <div class='conteudo'>
            
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            
        </div>

    </div>

    <div class='rodape'>
        <hr class='sem-espacamento'>
        <p class='sem-espacamento'>Assinado digitalmente por <strong>".$detalheApuracao[0]['quemCriouApuracao']."</strong></p>
    </div>

</body>
</html>
";

?>