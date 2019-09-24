<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Ocorrencia;

class MOcorrencia {

	public function cadastrar($idApuracao)
	{
		$sql = new Conexao;

		//Status
		//1 = Aberta
		//2 = Reaberta
		//3 = Arquivada
		//4 = Encerrada

		$sql->query("
			INSERT INTO tb_ocorrencia (idCriarApuracao, status) 
			VALUES(:idCriarApuracao, :status)
		", [
			":idCriarApuracao" => $idApuracao,
			":status" => 1
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_ocorrencia");
	}

	public function ultimoRegistro()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idOcorrencia) FROM tb_ocorrencia");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

}

?>