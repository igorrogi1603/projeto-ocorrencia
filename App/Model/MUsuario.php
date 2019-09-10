<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Usuario;
use \App\Classe\Validacao;

class MUsuario {

	const SESSION = "User";

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

	public function userIgual()
	{
		$sql = new Conexao;

		return $sql->select("SELECT user FROM tb_usuario");		
	}

	//Logar no sistema
	public static function login($login, $password)
	{

		$sql = new Conexao;

		$results = $sql->select("SELECT * FROM tb_usuario WHERE user = :user", array(
			":user"=>$login
		));

		if (count($results) === 0)
		{
			return false;
		}

		$data = $results[0];

		if (password_verify($password, $data["senha"]) === true)
		{
			$usuario = new Usuario();

			$usuario->setData($data);

			$_SESSION[Usuario::SESSION] = $usuario->getValues();

			return $usuario;

		} else {
			return false;
		}

	}

}

?>