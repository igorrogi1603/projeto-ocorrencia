<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Vitima;

class MVitima {

	public function cadastrar($idPessoa)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_vitimasapuracao (idPessoa) 
			VALUES(:idPessoa)
		", [
			":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"]
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_vitimasapuracao");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idVitimasApuracao) FROM tb_vitimasapuracao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function vitimaEspecificaVitimasApuracao($idVitimasApuracao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			b.idEndereco, b.idContato, b.nome, b.dataNasc, b.cpf, b.rg, b.sexo
			FROM tb_vitimasapuracao a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa
			WHERE a.idVitimasApuracao = :idVitimasApuracao
		", [
			":idVitimasApuracao" => $idVitimasApuracao
		]);
	}
}

?>