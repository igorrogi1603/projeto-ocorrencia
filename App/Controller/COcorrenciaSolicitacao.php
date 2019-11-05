<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MSolicitacao;

class COcorrenciaSolicitacao {

	public function listaSolicitacao($idOcorrencia)
	{
		$msolicitacao = new MSolicitacao;

		return $msolicitacao->listaSolicitacao($idOcorrencia);
	}

}

?>