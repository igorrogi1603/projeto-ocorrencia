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
			INSERT INTO tb_endereco (rua, numero, bairro, cidade, estado, complemento) 
			VALUES(:rua, :numero, :bairro, :cidade, :estado, :complemento)
		", [
			":rua" => $post[],
			":numero" => $post[],
			":bairro" => $post[],
			":cidade" => $post[],
			":estado" => $post[],
			":complemento" => $post[]
		]);

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idEndereco) FROM tb_endereco");

		if ($qtd->rowCount() > 0) {

			return $qtd;

		} else {
			return false;
		}

	}

}

?>