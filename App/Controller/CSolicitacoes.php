<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Model\MSolicitacao;

class CSolicitacoes {

	public static function getListaSolicitacoes($idUsuario)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;
		$validacao = new Validacao;

		//Recuperando a lista de pesso fisica e Instituicao
		$instituicao = $msolicitacao->listaSolicitacaoInstituicao($idUsuario);
		$pessoa = $msolicitacao->listaSolicitacao($idUsuario);

		//Validando os dados da Instituicao
		for ($i = 0; $i < count($instituicao); $i++) {
			$instituicao[$i]['assunto'] = utf8_encode($instituicao[$i]['assunto']);
			$instituicao[$i]['mensagem'] = utf8_encode($instituicao[$i]['mensagem']);
			$instituicao[$i]['nomeVitima'] = utf8_encode($instituicao[$i]['nomeVitima']);
			$instituicao[$i]['nomeDestinatario'] = utf8_encode($instituicao[$i]['nomeDestinatario']);
			$instituicao[$i]['dataCriacao'] = $validacao->replaceDataView($instituicao[$i]['dataCriacao']);
			$instituicao[$i]['isInstituicao'] = '1';
		}

		//Validando os dados da Pessoa
		for ($i = 0; $i < count($pessoa); $i++) {
			$pessoa[$i]['assunto'] = utf8_encode($pessoa[$i]['assunto']);
			$pessoa[$i]['mensagem'] = utf8_encode($pessoa[$i]['mensagem']);
			$pessoa[$i]['nomeVitima'] = utf8_encode($pessoa[$i]['nomeVitima']);
			$pessoa[$i]['nomeDestinatario'] = utf8_encode($pessoa[$i]['nomeDestinatario']);
			$pessoa[$i]['dataCriacao'] = $validacao->replaceDataView($pessoa[$i]['dataCriacao']);
			$pessoa[$i]['isInstituicao'] = '0';
		}

		if (isset($instituicao) && $instituicao != "" && $instituicao != null) {
			//Juntando os arrays
			foreach ($instituicao as $value) {
				$arrayNovo[] = $value;
			}
		}		

		if (isset($pessoa) && $pessoa != "" && $pessoa != null) {
			//Juntando os arrays
			foreach ($pessoa as $value) {
				$arrayNovo[] = $value;
			}
		}

		if (isset($arrayNovo) && $arrayNovo != "" && $arrayNovo != null) {
			return $arrayNovo;
		} else {
			return "";
		}
	}

	public static function getlerSolicitacao($idSolicitacao, $isInstituicao)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;
		$validacao = new Validacao;

		//Recuperando Resposta
		$listaResposta = $msolicitacao->listaSolicitacaoResposta($idSolicitacao);

		if ($isInstituicao == 1) {
			//Recuperando a lista da Instituicao
			$instituicao = $msolicitacao->solicitacaoEspecificaInstituicao($idSolicitacao);

			//Validando os dados da Instituicao
			for ($i = 0; $i < count($instituicao); $i++) {
				$instituicao[$i]['assunto'] = utf8_encode($instituicao[$i]['assunto']);
				$instituicao[$i]['mensagem'] = utf8_encode($instituicao[$i]['mensagem']);
				$instituicao[$i]['nomeVitima'] = utf8_encode($instituicao[$i]['nomeVitima']);
				$instituicao[$i]['nomeDestinatario'] = utf8_encode($instituicao[$i]['nomeDestinatario']);
				$instituicao[$i]['dataCriacao'] = $validacao->replaceDataView($instituicao[$i]['dataCriacao']);
				$instituicao[$i]['isInstituicao'] = '1';
				
				if (isset($listaResposta) && $listaResposta != "" && $listaResposta != null) {
					$instituicao[$i]['resposta'] = utf8_encode($listaResposta[$i]['resposta']);
				} else {
					$instituicao[$i]['resposta'] = "";
				}
			}

			return $instituicao;
		}

		if ($isInstituicao == 0) {
			//Recuperando a lista de pesso fisica
			$pessoa = $msolicitacao->listaOcorrenciaSolicitacaoPessoa($idSolicitacao);

			//Validando os dados da Pessoa
			for ($i = 0; $i < count($pessoa); $i++) {
				$pessoa[$i]['assunto'] = utf8_encode($pessoa[$i]['assunto']);
				$pessoa[$i]['mensagem'] = utf8_encode($pessoa[$i]['mensagem']);
				$pessoa[$i]['nomeVitima'] = utf8_encode($pessoa[$i]['nomeVitima']);
				$pessoa[$i]['nomeDestinatario'] = utf8_encode($pessoa[$i]['nomeDestinatario']);
				$pessoa[$i]['dataCriacao'] = $validacao->replaceDataView($pessoa[$i]['dataCriacao']);
				$pessoa[$i]['isInstituicao'] = '0';
				
				if (isset($listaResposta) && $listaResposta != "" && $listaResposta != null) {
					$pessoa[$i]['resposta'] = utf8_encode($listaResposta[$i]['resposta']);
				} else {
					$pessoa[$i]['resposta'] = "";
				}
			}

			return $pessoa;
		}

	}

	//Alterar status da lixeira da solicitacao
	public static function getSolicitacoesLixeira($idSolicitacao)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;

		$msolicitacao->alterarIsLixeira($idSolicitacao);
	}

	//Alterar status isResposta e cadastrar na tabela resposta da solicitacao
	public static function postSolicitacaoResponder($post, $idSolicitacao, $idOcorrencia)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;

		//cadastrando na tabela resposta
		$msolicitacao->cadastrarResposta($post, $idSolicitacao);

		//Alterar o isResposta para 1 que agora tem resposta na solicitacao
		$msolicitacao->alterarIsResposta($idSolicitacao);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfResponderSolicitacao.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Solicitacao".$idSolicitacao."resposta".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

		//Instancia o mpdf
		$mpdf = new Mpdf();	

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
		$marquivo->cadastrarArquivo('Solicitação Respondida', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
	}

}

?>