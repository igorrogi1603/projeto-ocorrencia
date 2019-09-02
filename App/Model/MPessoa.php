<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Pessoa;

class MPessoa {

	public function cadastrar($post, $idContato, $idEndereco)
	{

		$sql = new Conexao;

		$pessoa = new Pessoa;

		$pessoa->setData($post);

		$sql->query("
			INSERT INTO tb_pessoa (idEndereco, idContato, nome, dataNasc, cpf, rg, sexo) 
			VALUES(:idEndereco, :idContato, :nome, :dataNasc, :cpf, :rg, :sexo)
		", [
			":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
			":idContato" => (int)$idContato[0]["MAX(idContato)"],
			":nome" => $pessoa->getnomeUsuario(),
			":dataNasc" => $pessoa->replaceDataBd($pessoa->getdataNascUsuario()),
			":cpf" => $pessoa->replaceCpfBd($pessoa->getcpfUsuario()),
			":rg" => $pessoa->replaceRgBd($pessoa->getrgUsuario(), $pessoa->getrgDigitoUsuario()),
			":sexo" => $pessoa->getsexoUsuario()
		]);

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idPessoa) FROM tb_pessoa");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}

	}

}

?>