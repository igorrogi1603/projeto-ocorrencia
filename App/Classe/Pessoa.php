<?php

namespace App\Classe;

use \App\Config\GetSet;

class Pessoa extends GetSet {

	public function validarCpf()
	{

	}

	public function replaceCpfBd($cpf)
	{
		//tira os pontos e ifem 
		//para cadastrar no banco de dados sem erro
		$cpfProvisorio = str_replace(".", "", $cpf);
		$cpfProvisorio = str_replace("-", "", $cpfProvisorio);

		return $cpfProvisorio;
	}

	public function validarRg()
	{

	}

	public function replaceRgBd($rg, $digito)
	{
		//tirar os pontos para cadastrar no banco de dados
		$rgProvisorio = str_replace(".", "", $rg);

		//juntar com o digito verificador
		$rgCompleto = $rgProvisorio."".$digito;

		return $rgCompleto;
	}

	public function replaceDataBd($data)
	{
		//tirando as barras e trocando por ifens
		$dataProvisoria = str_replace("/", "-", $data);

		$dataCompleta = date("Y-m-d", strtotime($dataProvisoria));

		return $dataCompleta;
	}

	public function replaceDataView($data)
	{
		//tirando as barras e trocando por ifens
		$dataProvisoria = str_replace("-", "/", $data);

		$dataCompleta = date("d/m/Y", strtotime($dataProvisoria));

		return $dataCompleta;
	}

	public function qtdAnos($data)
	{

	}

}

?>