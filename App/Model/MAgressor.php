<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Agressor;
use \App\Classe\Validacao;

class MAgressor {

	public function cadastrar($id, $post, $complemento)
	{

		$sql = new Conexao;

		$agressor = new Agressor;
		$validacao = new Validacao;

		$agressor->setData($post);
		
		//isInstituicao
		// 1 = sim
		// 0 = nao

		switch ($complemento) {
			case 'agressor':
				$sql->query("
					INSERT INTO tb_agressor (idPessoa, idInstituicao, isInstituicao) 
					VALUES(:idPessoa, :idInstituicao, :isInstituicao)
				", [
					":idPessoa" => (int)$id[0]["MAX(idPessoa)"],
					":idInstituicao" => NULL,
					":isInstituicao" => 0
				]);	
				break;

			case 'instituicao':
				$sql->query("
					INSERT INTO tb_agressor (idPessoa, idInstituicao, isInstituicao) 
					VALUES(:idPessoa, :idInstituicao, :isInstituicao)
				", [
					":idPessoa" => NULL,
					":idInstituicao" => (int)$id[0]["MAX(idInstituicao)"],
					":isInstituicao" => 1
				]);	
				break;
		}
	}

	public function cadastrarOcorrenciaAgressor($idAgressor, $idOcorrencia)
	{
		$sql = new Conexao;

		$agressor = new Agressor;
		$validacao = new Validacao;

		$sql->query("
			INSERT INTO tb_ocorrenciaagressor (idOcorrencia, idAgressor) 
			VALUES(:idOcorrencia, :idAgressor)
		", [
			":idOcorrencia" => (int)$idOcorrencia,
			":idAgressor" => (int)$idAgressor[0]["MAX(idAgressor)"]
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_agressor");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idAgressor) FROM tb_agressor");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function listaAgressor($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT *
			FROM tb_ocorrenciaagressor a
			INNER JOIN tb_agressor b ON a.idAgressor = b.idAgressor
			INNER JOIN tb_pessoa c ON b.idPessoa = c.idPessoa
			INNER JOIN tb_endereco d ON c.idEndereco = d.idEndereco
			INNER JOIN tb_contato e ON c.idContato = e.idContato
			WHERE a.idOcorrencia = :idOcorrencia
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

	public function listaAgressorEspecifico($idOcorrencia, $idOcorrenciaAgressor)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT *
			FROM tb_ocorrenciaagressor a
			INNER JOIN tb_agressor b ON a.idAgressor = b.idAgressor
			INNER JOIN tb_pessoa c ON b.idPessoa = c.idPessoa
			INNER JOIN tb_endereco d ON c.idEndereco = d.idEndereco
			INNER JOIN tb_contato e ON c.idContato = e.idContato
			WHERE a.idOcorrencia = :idOcorrencia AND a.idOcorrenciaAgressor = :idOcorrenciaAgressor
		", [
			":idOcorrencia" => $idOcorrencia,
			":idOcorrenciaAgressor" => $idOcorrenciaAgressor
		]);	
	}

}

?>