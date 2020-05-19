<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MNotificacao;

class CHeader {

	public static function getNotificacao()
	{
		$mnotificacao = new MNotificacao;
		$validacao = new Validacao;

		$lista = $mnotificacao->listAll();

		for ($i = 0; $i < count($lista); $i++) {
			$lista[$i]['tipo'] = $lista[$i]['tipo'];
			$lista[$i]['dataRegistro'] = $validacao->replaceDataView($lista[$i]['dataRegistro']);

			$lista[$i]['url'] = str_replace("/", "!!", $lista[$i]['url']);
		}

		return $lista;
	}

}

?>