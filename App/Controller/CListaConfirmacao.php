<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;
use \App\Model\MOcorrencia;
use \App\Model\MNotificacao;
use \App\Model\MArquivo;

class CListaConfirmacao {
	
	//Botao de "CONFIMRAR" a apuracao
	public static function getConfirmacaoPositivo($idApuracao, $idConfirmacao)
	{
		$mapuracao = new MApuracao;
		$mocorrencia = new MOcorrencia;
		$marquivo = new MArquivo;
		$mnotificacao = new MNotificacao;

		//Recupero na tabela para ver se tem alguma informacao do usuario logado
		//Caso nessa tabela tenha uma informacao desse usuario quer dizer que ele ja votou
		$voto = count($mapuracao->recuperarGerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']));

		//Recupero as informacao da confirmacao para alterar os votos
		$confirmarApuracao = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);

		//Caso os votos negativos forem menores que dois entra aqui
		if ($confirmarApuracao[0]['isPositivo'] < 2) {
			if ($voto === 0){
				//Atualizando o isPositivo para mais um a partir do atual
				$mapuracao->updateConfirmacaoPositivo($idConfirmacao, $confirmarApuracao[0]['isPositivo']);

				//Cadastrando na tabela o usuario que ja votou pois nao pode votar duas vezes
				$mapuracao->gerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);
			} else {
				Validacao::setMsgError("Você já votou nessa apuracão.");
		        header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
		        exit;
			}
		}

		$confirmarApuracaoPronta = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);

		//Caso os votos forem dois entra aqui
		if ($confirmarApuracaoPronta[0]['isPositivo'] == 2) {
			//Mudar o status da apuracao para 3 (virou ocorrencia)
			$mapuracao->updateStatus(3, $idApuracao);
			
			//Cadastrar na tabela ocorrencia
			$mocorrencia->cadastrar($idApuracao);

			//Buscar a ocorrencia que foi cadastrada agora
			$idOcorrencia = $mocorrencia->ultimoRegistro();

			//Recuperar lista de apuracoes bloqueadas por usuario
			$listaBlokApuracao = $mocorrencia->listaBloquearOcorrenciaApuracao($idApuracao);

			foreach ($listaBlokApuracao as $value) {
				if ($value['idCriarApuracao'] == $idApuracao) {
					$mocorrencia->cadastrarBloquearOcorrencia($idOcorrencia[0]["MAX(idOcorrencia)"], $idApuracao);
				}
			}

			//Notificacao
			$mnotificacao->cadastrar("Nova Ocorrência", "/ocorrencia-detalhe/".$idOcorrencia[0]["MAX(idOcorrencia)"]);

			//Gerar nome da pasta
			$nomePasta = "ocorrencia".$idOcorrencia[0]["MAX(idOcorrencia)"];

			//Criar a pasta da ocorrencia
			mkdir('.'.DIRECTORY_SEPARATOR."Arquivos".DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$nomePasta);

			//--------------------------------------------------------
			//Gerar o PDF
			//Buscando o conteudo do pdf
			require_once('./App/Views-pdf/PdfCriarApuracao.php');

			//Nome do arquivo final
			$arquivo = "Apuracao".$idApuracao.".pdf";

			//Para onde vai o pdf
			$destino = ".".DIRECTORY_SEPARATOR."Arquivos".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

			//Instancia o mpdf
			$mpdf = new Mpdf();

			//Permitir marca d'agua
			$mpdf->showWatermarkText = true;

			//Coloca o html criado dentro da variavel para gerar o pdf
			$mpdf->WriteHTML($pagina);

			//Colocar o PDF dentro da pasta da ocorrencia criada
			$mpdf->Output($destino."".$arquivo, 'F');

			//--------------------------------------------------------
			//Preencher a tabela de arquivos da ocorrencia
			//criando a url
			$novaUrl = str_replace('.', '', $destino);
			$url = $novaUrl."".$arquivo;

			//Cadastrando na tabela tb_arquivos
			$marquivo->cadastrarArquivo('Apuração', $url);

			//Resgata o arquivo criado
			$idArquivo = $marquivo->ultimoRegistroArquivo();

			//registra na tabela tb_arquivosProcessoOcorrencia
			$marquivo->cadastrarArquivoOcorrencia($idOcorrencia[0]["MAX(idOcorrencia)"], $idArquivo[0]["MAX(idArquivo)"]);
		}
	}//Fim getConfirmacaoPositivo

	//-------------------------------------------------------------------------------------------------------------
	//Botao de "NAO CONFIMRAR" a apuracao 
	public static function getConfirmacaoNegativo($idApuracao, $idConfirmacao)
	{
		$mapuracao = new MApuracao;

		//Recupero na tabela para ver se tem alguma informacao do usuario logado
		//Caso nessa tabela tenha uma informacao desse usuario quer dizer que ele ja votou
		$voto = count($mapuracao->recuperarGerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']));

		//Recupero as informacao da confirmacao para alterar os votos
		$confirmarApuracao = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);		

		//Caso os votos negativos forem menores que dois entra aqui
		if ($confirmarApuracao[0]['isNegativo'] < 2) {
			if ($voto === 0){
				//Atualizando o isNegativo para mais um a partir do atual
				$mapuracao->updateConfirmacaoNegativo($idConfirmacao, $confirmarApuracao[0]['isNegativo']);

				//Cadastrando na tabela o usuario que ja votou pois nao pode votar duas vezes
				$mapuracao->gerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);
			} else {
				Validacao::setMsgError("Você já votou nessa apuracão.");
		        header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
		        exit;
			}
		}

		$confirmarApuracaoPronta = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);

		//Caso os votos forem dois entra aqui
		if ($confirmarApuracaoPronta[0]['isNegativo'] == 2) {
			//Descartar Apuracao
			header('Location: /confirmacao-detalhe/descartar/'.$idApuracao.'/'.$idConfirmacao);
			exit;
		}
	}//Fim getConfirmacaoNegativo

	//-------------------------------------------------------------------------------------------------------------
	public static function confirmacaoDetalheCancelar($idConfirmacao)
	{
		$mapuracao = new MApuracao;

		$isNegativo = $mapuracao->recuperarConfirmacaoNegativo($idConfirmacao);

		$mapuracao->updateConfirmacaoNegativoCancelar($idConfirmacao, $isNegativo[0]['isNegativo']);

		$mapuracao->deletarGerenciarConfirmacao($_SESSION[Usuario::SESSION]['idUsuario']);
	}

	//-------------------------------------------------------------------------------------------------------------
	public static function getConfirmacaoDetalhe($idApuracao)
	{
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$detalheConfirmacao = $mapuracao->listConfirmacao($idApuracao);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheConfirmacao);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$detalheConfirmacao[$i]['descricao'] = $detalheConfirmacao[$i]['descricao'];
			$detalheConfirmacao[$i]['tipoApuracao'] = $detalheConfirmacao[$i]['tipoApuracao'];
			$detalheConfirmacao[$i]['qualFamilia'] = $detalheConfirmacao[$i]['qualFamilia'];
			$detalheConfirmacao[$i]['nomeVitima'] = $detalheConfirmacao[$i]['nomeVitima'];
			$detalheConfirmacao[$i]['nomeResponsavel'] = $detalheConfirmacao[$i]['nomeResponsavel'];
			$detalheConfirmacao[$i]['ruaVitima'] = $detalheConfirmacao[$i]['ruaVitima'];
			$detalheConfirmacao[$i]['bairroVitima'] = $detalheConfirmacao[$i]['bairroVitima'];
			$detalheConfirmacao[$i]['cidadeVitima'] = $detalheConfirmacao[$i]['cidadeVitima'];
			$detalheConfirmacao[$i]['estadoVitima'] = strtoupper($detalheConfirmacao[$i]['estadoVitima']);
			$detalheConfirmacao[$i]['complementoVitima'] = $detalheConfirmacao[$i]['complementoVitima'];
			$detalheConfirmacao[$i]['ruaResponsavel'] = $detalheConfirmacao[$i]['ruaResponsavel'];
			$detalheConfirmacao[$i]['bairroResponsavel'] = $detalheConfirmacao[$i]['bairroResponsavel'];
			$detalheConfirmacao[$i]['cidadeResponsavel'] = $detalheConfirmacao[$i]['cidadeResponsavel'];
			$detalheConfirmacao[$i]['estadoResponsavel'] = strtoupper($detalheConfirmacao[$i]['estadoResponsavel']);
			$detalheConfirmacao[$i]['complementoResponsavel'] = $detalheConfirmacao[$i]['complementoResponsavel'];
			$detalheConfirmacao[$i]['cpfVitima'] = $validacao->replaceCpfView($detalheConfirmacao[$i]['cpfVitima']);
			$detalheConfirmacao[$i]['celularVitima'] = $validacao->replaceCelularView($detalheConfirmacao[$i]['celularVitima']);
			$detalheConfirmacao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($detalheConfirmacao[$i]['cpfResponsavel']);
			$detalheConfirmacao[$i]['celularResponsavel'] = $validacao->replaceCelularView($detalheConfirmacao[$i]['celularResponsavel']);
			$detalheConfirmacao[$i]['cepVitima'] = $validacao->replaceCepView($detalheConfirmacao[$i]['cepVitima']);
			$detalheConfirmacao[$i]['cepResponsavel'] = $validacao->replaceCepView($detalheConfirmacao[$i]['cepResponsavel']);
			$detalheConfirmacao[$i]['dataRegistro'] = $validacao->replaceDataView($detalheConfirmacao[$i]['dataRegistro']);
			$detalheConfirmacao[$i]['quemCriouApuracao'] = $detalheConfirmacao[$i]['quemCriouApuracao'];
		}
		
		return $detalheConfirmacao;
	}//Fim getConfirmacaoDetalhe

	//-------------------------------------------------------------------------------------------------------------
	//LISTA CONFIRMACAO
	public static function getListaConfirmacao()
	{	
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$listaConfirmacao = $mapuracao->listConfirmacaoCompleta();

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaConfirmacao);

		//Esse loop serve para tirar a duplicação de informação que vem do banco
		//Pois se tiver duas ou mais vitimas vinculada a apuracao entao ele se duplica
		//E para exibir essa lista nao pode repetir por isso excluir os dados repetidos
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaConfirmacao[$i])) {
				//se existe guarda em id
				$id = $listaConfirmacao[$i]['idCriarApuracao'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaConfirmacao[$a]['idCriarApuracao']) {
					$arrayPosicaoExcluir[] = $a;	
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaConfirmacao[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaConfirmacao[$i])) {
				$listaConfirmacao[$i]['descricao'] = $listaConfirmacao[$i]['descricao'];
				$listaConfirmacao[$i]['tipoApuracao'] = $listaConfirmacao[$i]['tipoApuracao'];
				$listaConfirmacao[$i]['qualFamilia'] = $listaConfirmacao[$i]['qualFamilia'];
				$listaConfirmacao[$i]['nomeVitima'] = $listaConfirmacao[$i]['nomeVitima'];
				$listaConfirmacao[$i]['nomeResponsavel'] = $listaConfirmacao[$i]['nomeResponsavel'];
				$listaConfirmacao[$i]['ruaVitima'] = $listaConfirmacao[$i]['ruaVitima'];
				$listaConfirmacao[$i]['bairroVitima'] = $listaConfirmacao[$i]['bairroVitima'];
				$listaConfirmacao[$i]['cidadeVitima'] = $listaConfirmacao[$i]['cidadeVitima'];
				$listaConfirmacao[$i]['estadoVitima'] = strtoupper($listaConfirmacao[$i]['estadoVitima']);
				$listaConfirmacao[$i]['complementoVitima'] = $listaConfirmacao[$i]['complementoVitima'];
				$listaConfirmacao[$i]['ruaResponsavel'] = $listaConfirmacao[$i]['ruaResponsavel'];
				$listaConfirmacao[$i]['bairroResponsavel'] = $listaConfirmacao[$i]['bairroResponsavel'];
				$listaConfirmacao[$i]['cidadeResponsavel'] = $listaConfirmacao[$i]['cidadeResponsavel'];
				$listaConfirmacao[$i]['estadoResponsavel'] = strtoupper($listaConfirmacao[$i]['estadoResponsavel']);
				$listaConfirmacao[$i]['complementoResponsavel'] = $listaConfirmacao[$i]['complementoResponsavel'];
				$listaConfirmacao[$i]['cpfVitima'] = $validacao->replaceCpfView($listaConfirmacao[$i]['cpfVitima']);
				$listaConfirmacao[$i]['celularVitima'] = $validacao->replaceCelularView($listaConfirmacao[$i]['celularVitima']);
				$listaConfirmacao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($listaConfirmacao[$i]['cpfResponsavel']);
				$listaConfirmacao[$i]['celularResponsavel'] = $validacao->replaceCelularView($listaConfirmacao[$i]['celularResponsavel']);
				$listaConfirmacao[$i]['cepVitima'] = $validacao->replaceCepView($listaConfirmacao[$i]['cepVitima']);
				$listaConfirmacao[$i]['cepResponsavel'] = $validacao->replaceCepView($listaConfirmacao[$i]['cepResponsavel']);
				$listaConfirmacao[$i]['dataRegistro'] = $validacao->replaceDataView($listaConfirmacao[$i]['dataRegistro']);
				$listaConfirmacao[$i]['registroConfirmacao'] = $validacao->replaceDataView($listaConfirmacao[$i]['registroConfirmacao']);
			}
		}

		return $listaConfirmacao;
	}//Fim getListaConfirmacao

}//Fim class

?>