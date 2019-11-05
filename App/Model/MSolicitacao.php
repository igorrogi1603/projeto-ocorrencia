<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Solicitacao;
use \App\Classe\Validacao;

class MSolicitacao {

	//Cadastrar na tabela Remetente
	public function cadastrarRemetente($idOcorrencia)
	{	
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_remetente (idOcorrencia) 
			VALUES(:idOcorrencia)
		", [
			":idOcorrencia" => (int)$idOcorrencia
		]);
	}

	//Cadastrar na tabela Destinatario
	public function cadastrarDestinatario($post)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_destinatario (idUsuario) 
			VALUES(:idUsuario)
		", [
			":idUsuario" => (int)$solicitacao->getpara()
		]);
	}

	//Cadastrar na tabela Solicitacao
	public function cadastrarSolicitacao($post, $idOcorrencia, $idRemetente, $idDestinatario)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_solicitacao (idOcorrencia, idRemetente, idDestinatario, assunto, mensagem, dataCriacao)
			VALUES(:idOcorrencia, :idRemetente, :idDestinatario, :assunto, :mensagem, :dataCriacao)
		", [
			":idOcorrencia" => (int)$idOcorrencia,
			":idRemetente" => (int)$idRemetente,
			":idDestinatario" => (int)$idDestinatario,
			":assunto" => utf8_decode($solicitacao->getassunto()),
			":mensagem" => utf8_decode($solicitacao->getmensagem()),
			":dataCriacao" => date("Y-m-d H:i:s")
		]);
	}

	//Cadastrar na tabela Resposta
	public function cadastrarResposta($post, $idSolicitacao)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_resposta (idSolicitacao, resposta) 
			VALUES(:idSolicitacao, :resposta)
		", [
			":idSolicitacao" => (int)$idSolicitacao,
			":resposta" => utf8_decode($solicitacao->getmensagem())
		]);
	}

	//Cadastrar na tabela SolicitacaoVitimas
	public function cadastrarSolicitacaoVitimas($idSolicitacao, $post)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_solicitacaovitimas (idSolicitacao, idVitimasApuracao) 
			VALUES(:idSolicitacao, :idVitimasApuracao)
		", [
			":idSolicitacao" => (int)$idSolicitacao,
			":idVitimasApuracao" => (int)$solicitacao->getvitima()
		]);
	}

	//Ultimo registro Remetente
	public function ultimoRegistroRemetente()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idRemetente) FROM tb_remetente");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Destinatario
	public function ultimoRegistroDestinatario()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idDestinatario) FROM tb_destinatario");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Solicitacao
	public function ultimoRegistroSolicitacao()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idSolicitacao) FROM tb_solicitacao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Resposta
	public function ultimoRegistroResposta()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idResposta) FROM tb_resposta");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

}

?>