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

				//isPais
				//1 = outro
				//2 = pai
				//3 = mae

				//isAindaResponsavel
				//1 = sim
				//0 = não

				$sql->query("
					INSERT INTO tb_responsavelapuracao (idPessoa, isPais, isAindaResponsavel) 
					VALUES(:idPessoa, :isPais, :isAindaResponsavel)
				", [
					":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"],
					":isPais" => 1,
					":isAindaResponsavel" => 1
				]);
				break;
			
			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	public function cadastrarResponsavelVitimas($idResponsavel, $idVitima, $complemento)
	{
		$sql = new Conexao;

		switch ($complemento) {
			case 'apuracao':
				$sql->query("
					INSERT INTO tb_responsavelvitimas (idResponsavelApuracao, idVitimasApuracao) 
					VALUES(:idResponsavelApuracao, :idVitimasApuracao)
				", [
					":idResponsavelApuracao" => (int)$idResponsavel[0]["MAX(idResponsavelApuracao)"],
					":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"]
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

	//Atualizar o responsavel da vitima
	public function updateResponsavelApuracao($post)
	{
		$sql = new Conexao;
		$responsavel = new Responsavel;

		$responsavel->setData($post);

		$sql->query("
			UPDATE tb_responsavelapuracao 
			SET isPais = :isPais, outro = :outro
			WHERE idResponsavelApuracao = :idResponsavelApuracao
		", [
			":isPais" => $responsavel->getresponsavelRadio(),
			":outro" => utf8_decode($responsavel->getresponsavelOutro()),
			":idResponsavelApuracao" => (int)$responsavel->getidResponsavelApuracao()
		]);
	}
}

?>