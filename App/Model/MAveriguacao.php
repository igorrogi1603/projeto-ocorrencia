<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Averiguacao;
use \App\Classe\Validacao;

class MAveriguacao {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$averiguacao = new Averiguacao;
		$validacao = new Validacao;

		$averiguacao->setData($post);

		$sql->query("
			INSERT INTO tb_criaraveriguacao (titulo, mensagem, status) 
			VALUES(:titulo, :mensagem, :status)
		", [
			":titulo" => $averiguacao->gettituloAveriguacao(),
			":mensagem" => $averiguacao->getmensagemAveriguacao(),
			":status" => 0
		]);
	}

	//Lista tudo da tabela
	public function listNaoLidas()
	{
		$sql = new Conexao;

		//status = 0 -> nao lida
		//status = 1 -> lida

		return $sql->select("
			SELECT * 
			FROM tb_criaraveriguacao
			WHERE status = :status
		", [
			":status" => 0
		]);
	}

	public function listLidas()
	{
		$sql = new Conexao;

		//status = 0 -> nao lida
		//status = 1 -> lida

		return $sql->select("
			SELECT * 
			FROM tb_criaraveriguacao
			WHERE status = :status
		", [
			":status" => 1
		]);
	}

	public function listEspecifico($idAveriguacao)
	{

		$sql = new Conexao;

		return $sql->select("
			SELECT * 
			FROM tb_criaraveriguacao
			WHERE idCriarAveriguacao = :idAveriguacao
		", [
			":idAveriguacao" => $idAveriguacao
		]);

	}

	public function updateStatusEspecifico($idAveriguacao)
	{

		$sql = new Conexao;

		$sql->query("
			UPDATE tb_criaraveriguacao 
			SET status = :status
			WHERE idCriarAveriguacao = :idAveriguacao
		", [
			":status" => 1,
			":idAveriguacao" => $idAveriguacao
		]);	

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idCriarAveriguacao) FROM tb_criaraveriguacao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

}

?>