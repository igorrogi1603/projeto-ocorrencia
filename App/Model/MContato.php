<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Contato;

class MContato {

	public function cadastrar($post)
	{

		//$sql = new Conexao;

		$contato = new Contato;

		$contato->setData($post);

		var_dump($contato->getValues());

		var_dump($contato->getcelularUsuario());

		//MUDAR TODOS OS NAME DOS IMPUT NO HTML

		exit;

		/*$sql->query("
			INSERT INTO tb_contato (celular, fixo, email) 
			VALUES(:celular, :fixo, :email)
		", [
			":celular" => $post[],
			":fixo" => $post[],
			":email" => $post[]
		]);*/

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idContato) FROM tb_contato");

		if ($qtd->rowCount() > 0) {

			return $qtd;

		} else {
			return false;
		}

	}

}

?>