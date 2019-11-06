<?php

namespace App\Controller;

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
			}

			return $pessoa;
		}

	}

}

?>