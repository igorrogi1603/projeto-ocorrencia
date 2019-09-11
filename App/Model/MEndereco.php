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

}

?>