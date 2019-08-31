<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Pessoa;

class MPessoa {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$pessoa = new Pessoa;

		$pessoa->setData($post);

		$sql->query("
			INSERT INTO tb_pessoa (idEndereco, idContato, nome, dataNasc, cpf, rg, sexo) 
			VALUES(:idEndereco, :idContato, :nome, :dataNasc, :cpf, :rg, :sexo)
		", [
			":idEndereco" => $post[],
			":idContato" => $post[],
			":nome" => $post[],
			":dataNasc" => $post[],
			":cpf" => $post[],
			":rg" => $post[],
			":sexo" => $post[]
		]);

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idPessoa) FROM tb_pessoa");

		if ($qtd->rowCount() > 0) {

			return $qtd;

		} else {
			return false;
		}

	}

}

?>