<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Pessoa;
use \App\Classe\Validacao;

class MPessoa {

	public function cadastrar($post, $idContato, $idEndereco)
	{
		$sql = new Conexao;

		$pessoa = new Pessoa;
		$validacao = new Validacao;

		$pessoa->setData($post);

		$sql->query("
			INSERT INTO tb_pessoa (idEndereco, idContato, nome, dataNasc, cpf, rg, sexo) 
			VALUES(:idEndereco, :idContato, :nome, :dataNasc, :cpf, :rg, :sexo)
		", [
			":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
			":idContato" => (int)$idContato[0]["MAX(idContato)"],
			":nome" => utf8_decode(strtolower($validacao->validarString($pessoa->getnomeUsuario(), 1))),
			":dataNasc" => $validacao->replaceDataBd($pessoa->getdataNascUsuario()),
			":cpf" => $validacao->replaceCpfBd($pessoa->getcpfUsuario()),
			":rg" => $validacao->replaceRgBd($pessoa->getrgUsuario(), $pessoa->getrgDigitoUsuario()),
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

	public function cpfIgual()
	{
		$sql = new Conexao;

		return $sql->select("SELECT cpf FROM tb_pessoa");		
	}

}

?>