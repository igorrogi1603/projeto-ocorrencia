<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Instituicao;
use \App\Classe\Validacao;

class MInstituicao {

	public function cadastrar($post, $idEndereco, $idContato)
	{

		$sql = new Conexao;

		$instituicao = new Instituicao;
		$validacao = new Validacao;

		$instituicao->setData($post);
		
		$sql->query("
			INSERT INTO tb_instituicao (idEndereco, idContato, nome, cnpj, status, subnome) 
			VALUES(:idEndereco, :idContato, :nome, :cnpj, :status, :subnome)
		", [
			":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
			":idContato" => (int)$idContato[0]["MAX(idContato)"],
			":nome" => utf8_decode($validacao->validarString($instituicao->getnomeInstituicao(), 1)),
			":cnpj" => $validacao->replaceCnpjBd($instituicao->getcnpjInstituicao()),
			":status" => $instituicao->getradioQualInstituicao(),
			":subnome" => utf8_decode($validacao->validarString($instituicao->getsubnomeInstituicao(), 1))
		]);
	}

	public function update($post, $idInstituicao, $complemento = "agressor")
	{
		$sql = new Conexao;

		$instituicao = new Instituicao;
		$validacao = new Validacao;		

		$instituicao->setData($post);

		switch ($complemento) {
			case 'agressor':
				$sql->query("
					UPDATE tb_instituicao
					SET nome = :nome, cnpj = :cnpj
					WHERE idInstituicao = :idInstituicao
				", [
					":nome" => utf8_decode($validacao->validarString($instituicao->getnomeAgressor(), 1)),
					":cnpj" => $validacao->replaceCnpjBd($instituicao->getcnpjAgressor()),
					":idInstituicao" => $idInstituicao
				]);
				break;

			case 'usuario':
				$sql->query("
					UPDATE tb_instituicao
					SET nome = :nome, cnpj = :cnpj
					WHERE idInstituicao = :idInstituicao
				", [
					":nome" => utf8_decode($validacao->validarString($instituicao->getnomeUsuario(), 1)),
					":cnpj" => $validacao->replaceCnpjBd($instituicao->getcnpjInstituicao()),
					":idInstituicao" => $idInstituicao
				]);
				break;
			
			default:
				# code...
				break;
		}
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_instituicao");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idInstituicao) FROM tb_instituicao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function listaInstituicao($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT *
			FROM tb_ocorrenciaagressor a
			INNER JOIN tb_agressor b ON a.idAgressor = b.idAgressor
			INNER JOIN tb_instituicao c ON b.idInstituicao = c.idInstituicao
			INNER JOIN tb_endereco d ON c.idEndereco = d.idEndereco
			INNER JOIN tb_contato e ON c.idContato = e.idContato
			WHERE a.idOcorrencia = :idOcorrencia
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

	public function listaInstituicaoEspecifica($idOcorrencia, $idOcorrenciaAgressor)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT *
			FROM tb_ocorrenciaagressor a
			INNER JOIN tb_agressor b ON a.idAgressor = b.idAgressor
			INNER JOIN tb_instituicao c ON b.idInstituicao = c.idInstituicao
			INNER JOIN tb_endereco d ON c.idEndereco = d.idEndereco
			INNER JOIN tb_contato e ON c.idContato = e.idContato
			WHERE a.idOcorrencia = :idOcorrencia AND a.idOcorrenciaAgressor = :idOcorrenciaAgressor
		", [
			":idOcorrencia" => $idOcorrencia,
			":idOcorrenciaAgressor" => $idOcorrenciaAgressor
		]);	
	}

	public function InstituicaoEspecifica($idInstituicao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * FROM tb_instituicao WHERE idInstituicao = :idInstituicao
		", [
			":idInstituicao" => $idInstituicao
		]);	
	}

	//Evitar de duplicar cpf no banco quando for atualizar uma pessoa
	public function cnpjIgualUpdate($idInstituicao)
	{
		$sql = new Conexao;

		return $sql->select("SELECT cnpj FROM tb_instituicao WHERE idInstituicao != :idInstituicao", [
			":idInstituicao" => $idInstituicao
		]);
	}

	//Evitar de duplicar cnpj no banco quando for cadastrar uma instituicao
	public function cnpjIgual()
	{
		$sql = new Conexao;

		return $sql->select("SELECT cnpj FROM tb_instituicao");		
	}

	public function excluirInstituicao($idInstituicao)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_instituicao WHERE idInstituicao = :idInstituicao", [
			"idInstituicao" => $idInstituicao
		]);
	}

}

?>