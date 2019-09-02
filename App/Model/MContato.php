<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Contato;

class MContato {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$contato = new Contato;

		$contato->setData($post);

		$sql->query("
			INSERT INTO tb_contato (celular, fixo, email) 
			VALUES(:celular, :fixo, :email)
		", [
			":celular" => $contato->replaceCelularBd($contato->getcelularUsuario()),
			":fixo" => $contato->replaceTelefoneFixoBd($contato->gettelFixoUsuario()),
			":email" => $contato->getemailUsuario()
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