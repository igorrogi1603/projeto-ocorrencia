<?php

namespace App\Classe;

use \App\Config\GetSet;

class Usuario extends GetSet {

	const SESSION = "User";

	//Cria uma criptografia para a senha
	public static function getPasswordHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}

	//Checar se esta logado
	public static function checkLogin($inadmin = true)
	{

		if (
			!isset($_SESSION[Usuario::SESSION])
			||
			!$_SESSION[Usuario::SESSION]
			||
			!(int)$_SESSION[Usuario::SESSION]["idUsuario"] > 0
		) {
			//Nao esta logado
			return false;

		} else {

			return true;

		}

	}

	public static function verifyLogin($inadmin = true)
	{
		if (!Usuario::checkLogin($inadmin))
		{	
			if ($inadmin) {
				header("Location: /login");	
			} else {
				return false;
			}
			exit;
		} 

		if ($_SESSION[Usuario::SESSION]["isBloqueado"] != 0) {
			if ($inadmin) {
				header("Location: /login");	
			} else {
				return false;
			}
			exit;	
		}

	}

	public static function logout()
	{
		$_SESSION[Usuario::SESSION] = NULL;
	}

	public static function getFromSession()
	{

		$usuario = new Usuario;

		if (isset($_SESSION[Usuario::SESSION]) && (int)$_SESSION[Usuario::SESSION]['idUsuario'] > 0) {

			$usuario->setData($_SESSION[Usuario::SESSION]);
			
		}

		return $usuario;
	}
	
}

?>