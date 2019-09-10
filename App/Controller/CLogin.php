<?php

namespace App\Controller;

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Model\MUsuario;

class CLogin {

	public static function postLogar($post)
	{
		$usuario = new Usuario;
		$musuario = new MUsuario;

		$verificarLogin = MUsuario::login($post['usernameUsuario'], $post['senhaUsuario']);

		if ($verificarLogin === false) {
			Validacao::setMsgError("Usuario ou senha inválidas, tente novamente.");
	        header('Location: /login');
	        exit;
		}

		header("Location: /");
		exit;
	}

}

?>