<?php

namespace App\Classe;

use \App\Config\GetSet;

class Contato extends GetSet {

	public function replaceCelularBd($celular)
	{
		//tirar os ifens para cadastrar no banco de dados
		$celularProvisorio = str_replace("-", "", $celular);
		$celularProvisorio = str_replace(" ", "", $celularProvisorio);

		return $celularProvisorio;
	}	

	public function replaceTelefoneFixoBd($fixo)
	{
		//tirar os ifens e espaços em brancos 
		//para cadastrar no banco de dados
		$fixoProvisorio = str_replace("-", "", $fixo);
		$fixoProvisorio = str_replace(" ", "", $fixoProvisorio);

		return $fixoProvisorio;
	}

}

?>