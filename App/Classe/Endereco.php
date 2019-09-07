<?php

namespace App\Classe;

use \App\Config\GetSet;

class Endereco extends GetSet {

	public function validarLetraAcento($variavel)
	{
		return preg_replace("/[^a-zA-Zà-úÀ-Ú\s]/", "", $variavel);
	}

	public function validarLetraAcentoNumero($variavel)
	{
		return preg_replace("/[^a-zA-Zà-úÀ-Ú0-9\s]/", "", $variavel);
	}

	public function validarNumero($variavel)
	{
		return preg_replace("/[^0-9\s]/", "", $variavel);
	}

}

?>