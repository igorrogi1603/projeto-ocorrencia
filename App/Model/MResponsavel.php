<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Responsavel;

class MResponsavel {

	public function cadastrar($idPessoa, $complemento)
	{
		$sql = new Conexao;

		switch ($complemento) {
			case 'apuracao':
				$sql->query("
					INSERT INTO tb_responsavelapuracao (idPessoa) 
					VALUES(:idPessoa)
				", [
					":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"]
				]);
				break;
			
			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_responsavelapuracao");
	}

	//Listar responsavel expecifico
	public function listResponsavel($idResponsavel)
	{
		$sql = new Conexao;

		return $sql->select("SELECT a.idResponsavelApuracao, a.idPessoa FROM tb_responsavelapuracao a WHERE idResponsavelApuracao = :idResponsavel", [
			":idResponsavel" => $idResponsavel
		]);	
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idResponsavelApuracao) FROM tb_responsavelapuracao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

}

?>