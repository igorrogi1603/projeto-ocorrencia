<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Usuario;
use \App\Classe\Validacao;

class MUsuario {

	public function cadastrar($post, $idPessoa)
	{

		$sql = new Conexao;

		$usuario = new Usuario;
		$validacao = new Validacao;

		$usuario->setData($post);

		$sql->query("
			INSERT INTO tb_usuario (idPessoa, nivelAcesso, user, senha, funcao, setor) 
			VALUES(:idPessoa, :nivelAcesso, :user, :senha, :funcao, :setor)
		", [
			":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"],
			":nivelAcesso" => $usuario->getnivelUsuario(),
			":user" => Validacao::tirarAcentos($usuario->getusernameUsuario()),
			":senha" => Usuario::getPasswordHash($usuario->getsenhaUsuario()),
			":funcao" => utf8_decode($usuario->getfuncaoUsuario()),
			":setor" => $usuario->getsetorUsuario()
		]);

	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idUsuario) FROM tb_usuario");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}

	}


}

?>