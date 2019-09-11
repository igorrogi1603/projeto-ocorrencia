<?php

namespace App\Controller;

use \App\Model\MUsuario;

class CListaUsuario {

	public static function getListaUsuario()
	{
		$musuario = new MUsuario;

		$dados = $musuario->listaUsuario();

		for ($i = 0; $i < count($dados); $i++) {
			$dados[$i]['nome'] = utf8_encode($dados[$i]['nome']);
			$dados[$i]['setor'] = utf8_encode($dados[$i]['setor']);
			$dados[$i]['funcao'] = utf8_encode($dados[$i]['funcao']);
		}

		return $dados;
	}

}

?>