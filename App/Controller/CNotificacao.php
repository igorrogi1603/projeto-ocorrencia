<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MNotificacao;

class CNotificacao {

	public static function getExcluirNotificacao($idNotificacao)
	{
		$mnotificacao = new MNotificacao;

		$mnotificacao->excluirNotificacao($idNotificacao);
	}

}

?>