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

}

?>