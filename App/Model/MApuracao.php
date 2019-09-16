<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Apuracao;
use \App\Classe\Validacao;

class MApuracao {

	public function cadastrar($post, $idUsuario)
	{
		$sql = new Conexao;

		$apuracao = new Apuracao;
		$validacao = new Validacao;

		$apuracao->setData($post);

		//Status
		//1 = criada esperando para continuar
		//2 = gerada ocorrencia, foi para confirmacao
		//3 = virou ocorrencia
		//4 = excluida

		$sql->query("
			INSERT INTO tb_criarapuracao (idUsuario, tipoApuracao, descricao, status) 
			VALUES(:idUsuario, :tipoApuracao, :descricao, :status)
		", [
			":idUsuario" => $idUsuario,
			":tipoApuracao" => utf8_decode($apuracao->gettipoApuracao()),
			":descricao" => utf8_decode($apuracao->getdescricaoApuracao()),
			":status" => 1
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_criarapuracao");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idCriarApuracao) FROM tb_criarapuracao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//----------------------------------------------------------------
	//CADASTRAR NA TABELA VitimasCriarApuracao 
	//----------------------------------------------------------------
	public function cadastrarVitimasCriarApuracao($idVitima, $idApuracao)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_vitimascriarapuracao (idVitimasApuracao, idCriarApuracao) 
			VALUES(:idVitimasApuracao, :idCriarApuracao)
		", [
			":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"],
			":idCriarApuracao" => (int)$idApuracao[0]["MAX(idCriarApuracao)"]
		]);
	}

	//----------------------------------------------------------------
	//CADASTRAR NA TABELA FamiliaApuracao
	//----------------------------------------------------------------
	public function cadastrarFamiliaApuracao($post, $idApuracao, $idVitima, $idResponsavel)
	{
		$sql = new Conexao;

		$apuracao = new Apuracao;

		$apuracao->setData($post);

		$sql->query("
			INSERT INTO tb_familiaapuracao (idCriarApuracao, idVitimasApuracao, idResponsavelApuracao, qualFamilia) 
			VALUES(:idCriarApuracao, :idVitimasApuracao, :idResponsavelApuracao, :qualFamilia)
		", [
			":idCriarApuracao" => (int)$idApuracao[0]["MAX(idCriarApuracao)"],
			":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"],
			":idResponsavelApuracao" => (int)$idResponsavel[0]["MAX(idResponsavelApuracao)"],
			":qualFamilia" => utf8_decode($apuracao->getqualFamiliaVitima())
		]);	
	}

}

?>