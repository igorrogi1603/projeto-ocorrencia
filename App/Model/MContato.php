<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Contato;
use \App\Classe\Validacao;

class MContato {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$contato = new Contato;
		$validacao = new Validacao;

		$contato->setData($post);

		$sql->query("
			INSERT INTO tb_contato (celular, fixo, email) 
			VALUES(:celular, :fixo, :email)
		", [
			":celular" => $validacao->replaceCelularBd($contato->getcelularUsuario()),
			":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoUsuario()),
			":email" => utf8_decode($contato->getemailUsuario())
		]);
	}

	public function update($post, $idContato)
	{
		$sql = new Conexao;

		$contato = new Contato;
		$validacao = new Validacao;		

		$contato->setData($post);

		$sql->query("
			UPDATE tb_contato 
			SET celular = :celular, fixo = :fixo, email = :email
			WHERE idContato = :idContato
		", [
			":celular" => $validacao->replaceCelularBd($contato->getcelularUsuario()),
			":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoUsuario()),
			":email" => utf8_decode($contato->getemailUsuario()),
			":idContato" => $idContato
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_contato");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idContato) FROM tb_contato");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function excluirContato($idContato)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_contato WHERE idContato = :idContato", [
			"idContato" => $idContato
		]);
	}

}

?>