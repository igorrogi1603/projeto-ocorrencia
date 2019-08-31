<?php

namespace App\Controller;

use \App\Model\MContato;

class CCadastrarUsuario {

	public static function postCadastrarUsuario($post)
	{

		$mcontato = new MContato;

		$mcontato->cadastrar($post);

	}

}
?>