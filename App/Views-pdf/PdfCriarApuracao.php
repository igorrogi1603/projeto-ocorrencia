<?php
use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;

//instaciando
$mapuracao = new MApuracao;
$validacao = new Validacao;

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
}

//HTML DO RELATORIO
$pagina = 

"
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Relatório Apuração</title>

        <style>
            h1 {
                font-size: 16px;
                font-weight: bold;
                margin: 0px;
                padding: 0px;
            }

            h2 {
                font-size: 14px;
                font-weight: bold;
                margin: 0px;
                padding: 0px;
            }

            hr {
                border-color: #eee;
            }

            .font {
                font-family: Arial, Helvetica, sans-serif;
                padding: 0px;
                margin: 0px;
            }

            .container {
                margin: 0px;
            }

            .container-header {
                width: 100%;
            }

            .cabecalho-esquerda {
                width: 100%;
            }

            .cabecalho-direita {
                float: right;
                width: 50%;           
            }

            .container-body {
                width: 100%;
                clear: both;
            }

            .container-data {
                width: 100%;
            }

            .container-detalhe {
                width: 100%;
            }

            .direita {
                float: right;
            }

            .esquerda {
                float: left;
            }

            .data {
                font-size: 12px;
                font-weight: bold;
                margin: 0px;
                padding: 0px;
            }

            .bot{
                margin-bottom: 10px;
            }

            .bot2 {
                margin-bottom: 20px;
            }

            .categoria {
                font-size: 12px;
            }

            .metade {
                width: 50%;
            }

            .footer {
                position:absolute;
                bottom:0;
                width:100%;
            }

            .assinatura {
                font-size: 12px;
                margin: 0px;
                padding: 0px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='container-header'>
                <div class='cabecalho-esquerda'>
                    <h1 class='esquerda font'><img src='/res/site/dist/img/logo-preta.png' width='20' height='20'> SISTEMA DE OCORRÊNCIA MUNICIPAL</h1>
                </div>
            </div>

            <hr>

            <div class='container-data'>
            	<p class='categoria font'><strong>Número Apuração: </strong>".$detalheApuracao[0]['idCriarApuracao']."</p>
                <p class='categoria font'><strong>Data: </strong>".$detalheApuracao[0]['dataRegistro']."</p>
            </div>
            <hr>

            ";
            

            for ($i = 0; $i < $tamanhoArray; $i++) {
            $pagina .= "
            <div class='container-body'>
                <h2 class='font bot'>Dados Vítima</h2>

                <div class='metade esquerda'>";
                    $pagina .= "<p class='font categoria'><strong>Nome da Vítima: </strong>".$detalheApuracao[$i]['nomeVitima']."</p>";
                    if ($detalheApuracao[$i]['sexoVitima'] == 'm') {
                    	$pagina .= "<p class='font categoria'><strong>Sexo: </strong>Masculino</p>";
                    }
                    if ($detalheApuracao[$i]['sexoVitima'] == 'f') {
                    	$pagina .= "<p class='font categoria'><strong>Sexo: </strong>Feminino</p>";
                    }
                    $pagina .= "<p class='font categoria'><strong>CPF: </strong>".$detalheApuracao[$i]['cpfVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Celular: </strong>".$detalheApuracao[$i]['celularVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Nome Responsavel: </strong>".$detalheApuracao[$i]['nomeResponsavel']."</p>";
                    $pagina .= "<p class='font categoria'><strong>CPF Responsavel: </strong>".$detalheApuracao[$i]['cpfResponsavel']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Celular Responsavel: </strong>".$detalheApuracao[$i]['celularResponsavel']."</p>";
                $pagina .= "</div>";

                $pagina .= "<div class='metade direita'>";
                    $pagina .= "<p class='font categoria'><strong>CEP: </strong>".$detalheApuracao[$i]['cepVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Rua: </strong>".$detalheApuracao[$i]['ruaVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Número: </strong>".$detalheApuracao[$i]['numeroVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Bairro: </strong>".$detalheApuracao[$i]['bairroVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Cidade: </strong>".$detalheApuracao[$i]['cidadeVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Estado: </strong>".$detalheApuracao[$i]['estadoVitima']."</p>";
                    $pagina .= "<p class='font categoria'><strong>Complemento: </strong>".$detalheApuracao[$i]['complementoVitima']."</p>";
                $pagina .= "</div>
                <hr>
            </div>

            ";
        	}
            $pagina .= "

            <div class='container-detalhe'>
                <h2 class='font bot'>Detalhe</h2>

                <p class='font categoria'><strong>Tipo da Apuração: </strong>".$detalheApuracao[0]['tipoApuracao']."</p>
                <p class='font categoria'><strong>Descrição: </strong>".$detalheApuracao[0]['descricao']."</p>
            </div>
        </div>

        <div class='footer'>
            <p class='font assinatura'><strong>".$detalheApuracao[0]['quemCriouApuracao']."</strong> concordou com os termos impostos pelo sistema e se responsabilizo por esse documento.</p>
        </div>
    </body>
</html>
";

?>