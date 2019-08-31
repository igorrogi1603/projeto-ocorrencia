<?php

namespace App\Model;

use App\Config\Conexao;
use App\Classe\Usuario;

class MUsuario {

	public function cadastrar($post)
	{

		$sql = new Conexao;

		$usuario = new Usuario;

		$usuario->setData($post);

		$sql->query("
			INSERT INTO tb_usuario (idPessoa, nivelAcesso, user, senha, funcao) 
			VALUES(:idPessoa, :nivelAcesso, :user, :senha, :funcao)
		", [
			":idPessoa" => $post[],
			":nivelAcesso" => $post[],
			":user" => $post[],
			":senha" => Usuario::getPasswordHash($post[]),
			":funcao" => $post[]
		]);

	}

}

?>