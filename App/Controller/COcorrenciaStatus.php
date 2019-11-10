<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;

class COcorrenciaStatus {

	public static function getArquivar($idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;

		$mocorrencia->arquivarOcorrencia($idOcorrencia);		
	}

	public static function getEncerrar($idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;

		$mocorrencia->encerrarOcorrencia($idOcorrencia);
	}

	public static function getReabrir($idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;

		$mocorrencia->reabrirOcorrencia($idOcorrencia);
	}

}

?>