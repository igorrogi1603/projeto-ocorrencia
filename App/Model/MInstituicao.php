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
			INSERT INTO tb_instituicao (idEndereco, idContato, nome, cnpj) 
			VALUES(:idEndereco, :idContato, :nome, :cnpj)
		", [
			":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
			":idContato" => (int)$idContato[0]["MAX(idContato)"],
			":nome" => utf8_decode($validacao->validarString($instituicao->getnomeInstituicao(), 1)),
			":cnpj" => $validacao->replaceCnpjBd($instituicao->getcnpjInstituicao())
		]);
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

}

?>