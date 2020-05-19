<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MSolicitacao;

class COcorrenciaSolicitacao {

	public static function getListaSolicitacao($idOcorrencia)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;
		$validacao = new Validacao;

		//Recuperando a lista de pesso fisica e Instituicao
		$instituicao = $msolicitacao->listaOcorrenciaSolicitacaoInstituicao($idOcorrencia);
		$pessoa = $msolicitacao->listaOcorrenciaSolicitacao($idOcorrencia);

		//Validando os dados da Instituicao
		for ($i = 0; $i < count($instituicao); $i++) {
			$instituicao[$i]['assunto'] = $instituicao[$i]['assunto'];
			$instituicao[$i]['mensagem'] = $instituicao[$i]['mensagem'];
			$instituicao[$i]['nomeVitima'] = $instituicao[$i]['nomeVitima'];
			$instituicao[$i]['nomeDestinatario'] = $instituicao[$i]['nomeDestinatario'];
			$instituicao[$i]['dataCriacao'] = $validacao->replaceDataView($instituicao[$i]['dataCriacao']);
			$instituicao[$i]['isInstituicao'] = '1';
		}

		//Validando os dados da Pessoa
		for ($i = 0; $i < count($pessoa); $i++) {
			$pessoa[$i]['assunto'] = $pessoa[$i]['assunto'];
			$pessoa[$i]['mensagem'] = $pessoa[$i]['mensagem'];
			$pessoa[$i]['nomeVitima'] = $pessoa[$i]['nomeVitima'];
			$pessoa[$i]['nomeDestinatario'] = $pessoa[$i]['nomeDestinatario'];
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

	public static function getlerSolicitacao($idOcorrencia, $idSolicitacao, $isInstituicao)
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
				$instituicao[$i]['assunto'] = $instituicao[$i]['assunto'];
				$instituicao[$i]['mensagem'] = $instituicao[$i]['mensagem'];
				$instituicao[$i]['nomeVitima'] = $instituicao[$i]['nomeVitima'];
				$instituicao[$i]['nomeDestinatario'] = $instituicao[$i]['nomeDestinatario'];
				$instituicao[$i]['dataCriacao'] = $validacao->replaceDataView($instituicao[$i]['dataCriacao']);
				$instituicao[$i]['isInstituicao'] = '1';

				if (isset($listaResposta) && $listaResposta != "" && $listaResposta != null) {
					$instituicao[$i]['resposta'] = $listaResposta[$i]['resposta'];
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
				$pessoa[$i]['assunto'] = $pessoa[$i]['assunto'];
				$pessoa[$i]['mensagem'] = $pessoa[$i]['mensagem'];
				$pessoa[$i]['nomeVitima'] = $pessoa[$i]['nomeVitima'];
				$pessoa[$i]['nomeDestinatario'] = $pessoa[$i]['nomeDestinatario'];
				$pessoa[$i]['dataCriacao'] = $validacao->replaceDataView($pessoa[$i]['dataCriacao']);
				$pessoa[$i]['isInstituicao'] = '0';

				if (isset($listaResposta) && $listaResposta != "" && $listaResposta != null) {
					$pessoa[$i]['resposta'] = $listaResposta[$i]['resposta'];
				} else {
					$pessoa[$i]['resposta'] = "";
				}
			}

			return $pessoa;
		}

	}

}

?>