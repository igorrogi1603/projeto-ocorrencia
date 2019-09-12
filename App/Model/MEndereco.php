<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Endereco;

class MEndereco {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$endereco = new Endereco;

		$endereco->setData($post);

		$sql->query("
			INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
			VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
		", [
			":cep" => $endereco->getcepUsuario(),
			":rua" => utf8_decode($endereco->getruaUsuario()),
			":numero" => $endereco->getnumeroUsuario(),
			":bairro" => utf8_decode($endereco->getbairroUsuario()),
			":cidade" => utf8_decode($endereco->getcidadeUsuario()),
			":estado" => $endereco->getestadoUsuario(),
			":complemento" => utf8_decode($endereco->getcomplementoUsuario())
		]);

	}

	public function update($post, $idEndereco)
	{
		$sql = new Conexao;

		$endereco = new Endereco;

		$endereco->setData($post);

		$sql->query("
			UPDATE tb_endereco 
			SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
			WHERE idEndereco = :idEndereco
		", [
			":cep" => $endereco->getcepUsuario(),
			":rua" => utf8_decode($endereco->getruaUsuario()),
			":numero" => $endereco->getnumeroUsuario(),
			":bairro" => utf8_decode($endereco->getbairroUsuario()),
			":cidade" => utf8_decode($endereco->getcidadeUsuario()),
			":estado" => $endereco->getestadoUsuario(),
			":complemento" => utf8_decode($endereco->getcomplementoUsuario()),
			":idEndereco" => $idEndereco
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_endereco");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idEndereco) FROM tb_endereco");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function excluirEndereco($idEndereco)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_endereco WHERE idEndereco = :idEndereco", [
			"idEndereco" => $idEndereco
		]);
	}

}

?>