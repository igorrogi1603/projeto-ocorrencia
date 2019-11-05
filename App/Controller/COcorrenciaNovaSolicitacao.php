<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MSolicitacao;
use \App\Controller\CListaUsuario;
use \App\Controller\CDetalheOcorrencia;

class COcorrenciaNovaSolicitacao {

	public static function getNovaSolicitacaoVitima($idOcorrencia)
	{
		//recuperando dados do Controller CDetalheOcorrencia
		$dados = CDetalheOcorrencia::getOcorrenciaDetalhe($idOcorrencia);

		foreach ($dados as $value) {
			$novoArray[] = $value;
		}

		return $novoArray;
	}

	public static function getNovaSolicitacaoUsuario()
	{
		//recuperando dados do Controller CListaUsuario
		$dados = CListaUsuario::getListaUsuario();

		foreach ($dados as $value) {
			if ($value['nivelAcesso'] == '2') {
				$novoArray[] = $value;
			}
		}

		return $novoArray;
	}

	public static function postNovaSolicitacao($post, $idOcorrencia)
	{
		//Instancia
		$msolicitacao = new MSolicitacao;
		$validacao = new Validacao;

		//Validando os post
		$post['assunto'] = $validacao->validarString($post['assunto'], 2);

		//processo de cadastrar a solicitacao
		//Cadastrar remetente
		$msolicitacao->cadastrarRemetente($idOcorrencia);
		
		//Cadastrar Destinatario
		$msolicitacao->cadastrarDestinatario($post);

		//Recuperando idRemetente e idDestinatario
		$idRemetente = $msolicitacao->ultimoRegistroRemetente();
		$idDestinatario = $msolicitacao->ultimoRegistroDestinatario();

		//Cadastrar Solicitcao
		$msolicitacao->cadastrarSolicitacao($post, $idOcorrencia, $idRemetente[0]['MAX(idRemetente)'], $idDestinatario[0]['MAX(idDestinatario)']);

		//Recuperando idSolicitacao
		$idSolicitacao = $msolicitacao->ultimoRegistroSolicitacao();

		//Cadastrar na tabela SolicitacaoVitimas
		$msolicitacao->cadastrarSolicitacaoVitimas($idSolicitacao[0]['MAX(idSolicitacao)'], $post);
	}

}

?>