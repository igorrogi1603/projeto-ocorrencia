<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Endereco;
use \App\Classe\Validacao;

class MAcompanhamento {

	public function cadastrar($post, $idVitima)
	{
		$sql = new Conexao;

		$endereco = new Endereco;
		$validacao = new Validacao;

		$endereco->setData($post);

		//status
		//0 = endereco atual
		//1 = endereco antigo

		$sql->query("
			INSERT INTO tb_acompanhamentovitima (idVitimasApuracao, cep, rua, numero, bairro, cidade, estado, complemento, status, dataRegistro) 
			VALUES(:idVitimaApuracao, :cep, :rua, :numero, :bairro, :cidade, :estado, :complemento, :status, :dataRegistro)
		", [
			":idVitimaApuracao" => (int)$idVitima,
			":cep" => $endereco->getcepVitima(),
			":rua" => $endereco->getruaVitima(),
			":numero" => $endereco->getnumeroVitima(),
			":bairro" => $endereco->getbairroVitima(),
			":cidade" => $endereco->getcidadeVitima(),
			":estado" => $endereco->getestadoVitima(),
			":complemento" => $endereco->getcomplementoVitima(),
			":status" => 0,
			":dataRegistro" => date("Y-m-d H:i:s")
		]);
	}

	public function update($idAcompanhamentoVitima)
	{	
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_acompanhamentovitima 
			SET status = :status
			WHERE idAcompanhamentoVitima = :idAcompanhamentoVitima
		", [
			":status" => 1,
			":idAcompanhamentoVitima" => $idAcompanhamentoVitima
		]);
	}

	//Lista tudo da tabela
	public function listAll($idVitima)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_acompanhamentovitima WHERE idVitimaApuracao = :idVitimaApuracao AND status = :status", [
			":idVitimaApuracao" => $idVitima,
			":status" => 0
		]);
	}

	//Lista tudo da tabela
	public function listaAcompanhamentoGeral($idVitima)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_acompanhamentovitima WHERE idVitimasApuracao = :idVitimasApuracao ORDER BY idAcompanhamentoVitima DESC", [
			":idVitimasApuracao" => $idVitima
		]);
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idAcompanhamentoVitima) FROM tb_acompanhamentovitima");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

}

?>