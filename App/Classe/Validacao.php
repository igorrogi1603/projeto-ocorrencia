<?php

namespace App\Classe;

use \App\Config\GetSet;

class Validacao {

	const SESSION_ERROR = "ValidacaoErro";

	//Tirar acentos das palavras apenas substitui o elemento com acento por o mesmo elemento sem acento
	public static function tirarAcentos($string){
    	return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	}

	//Exclui o elemento que nao puder conter na string
	public function validarString($variavel, $indece)
	{
		switch ($indece) {
			case 1:
				return preg_replace("/[^a-zA-Zà-úÀ-Ú\s]/", "", $variavel);
				break;

			case 2:
				return preg_replace("/[^a-zA-Zà-úÀ-Ú0-9\s]/", "", $variavel);
				break;

			case 3:
				return preg_replace("/[^0-9\s]/", "", $variavel);
				break;

			case 4:
				return preg_replace("/[^a-zA-Z0-9\s]/", "", $variavel);
				break;

			default:
				return false;
				break;
		}
	}

	public function validaCPF($cpf = null) {
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}

		// Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
			
			for ($t = 9; $t < 11; $t++) {
				
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	public function replaceCpfBd($cpf)
	{
		//tira os pontos e ifem 
		//para cadastrar no banco de dados sem erro
		$cpfProvisorio = str_replace(".", "", $cpf);
		$cpfProvisorio = str_replace("-", "", $cpfProvisorio);

		return $cpfProvisorio;
	}

	public function replaceCpfView($cpf)
	{
		if ($cpf != null || $cpf != "") {
			$campo1 = substr($cpf, 0, 3);
			$campo2 = substr($cpf, 3, 3);
			$campo3 = substr($cpf, 6, 3);
			$campo4 = substr($cpf, 9, 2);

			$cpfCompleto = $campo1.".".$campo2.".".$campo3."-".$campo4;

			return $cpfCompleto;
		} else {
			return "";
		}
	}

	public function replaceDigitoRg($rg)
	{
		//pegar apenas o digito do rg
		return substr($rg, 8, 1);
	}

	public function replaceSemDigitoRg($rg)
	{
		//pegar apenas o digito do rg
		return substr($rg, 0, 8);
	}

	public function replaceRgBd($rg, $digito)
	{
		//tirar os pontos para cadastrar no banco de dados
		$rgProvisorio = str_replace(".", "", $rg);

		//juntar com o digito verificador
		$rgCompleto = $rgProvisorio."".$digito;

		return $rgCompleto;
	}

	public function replaceRgView($rg)
	{
		if ($rg != null || $rg != "") {
			$campo1 = substr($rg, 0, 2);
			$campo2 = substr($rg, 2, 3);
			$campo3 = substr($rg, 5, 3);
			$campo4 = substr($rg, 8, 1);

			$rgCompleto = $campo1.".".$campo2.".".$campo3."-".$campo4;

			return $rgCompleto;
		} else {
			return "";
		}
	}

	//tirando as barras e trocando por ifens
	public function replaceDataBd($data)
	{
		$dataProvisoria = str_replace("/", "-", $data);

		$dataCompleta = date("Y-m-d", strtotime($dataProvisoria));

		return $dataCompleta;
	}

	//tirando as barras e trocando por ifens
	public function replaceDataView($data)
	{
		$dataProvisoria = str_replace("-", "/", $data);

		$dataCompleta = date("d/m/Y", strtotime($dataProvisoria));

		return $dataCompleta;
	}

	public function replaceCelularBd($celular)
	{
		//tirar os ifens para cadastrar no banco de dados
		$celularProvisorio = str_replace("-", "", $celular);
		$celularProvisorio = str_replace(" ", "", $celularProvisorio);

		return $celularProvisorio;
	}

	public function replaceCelularView($celular)
	{
		if ($celular != null || $celular != "") {
			$campo1 = substr($celular, 0, 2);
			$campo2 = substr($celular, 2, 5);
			$campo3 = substr($celular, 7, 4);

			$celularCompleto = "(".$campo1.") ".$campo2."-".$campo3;

			return $celularCompleto;
		} else {
			return "";
		}
	}

	public function replaceTelefoneFixoBd($fixo)
	{
		//tirar os ifens e espaços em brancos 
		//para cadastrar no banco de dados
		$fixoProvisorio = str_replace("-", "", $fixo);
		$fixoProvisorio = str_replace(" ", "", $fixoProvisorio);

		return $fixoProvisorio;
	}

	public function replaceTelefoneFixoView($fixo)
	{	
		if ($fixo != null || $fixo != "") {
			$campo1 = substr($fixo, 0, 2);
			$campo2 = substr($fixo, 2, 4);
			$campo3 = substr($fixo, 6, 4);

			$fixoCompleto = "(".$campo1.") ".$campo2."-".$campo3;

			return $fixoCompleto;
		} else {
			return "";
		}
	}

	public function replaceCepView($cep)
	{
		if ($cep != null || $cep != "") {
			$campo1 = substr($cep, 0, 5);
			$campo2 = substr($cep, 5, 3);

			$cepCompleto = $campo1."-".$campo2;

			return $cepCompleto;
		} else {
			return "";
		}
	}
	
	//MENSAGEM DE ERRO
	public static function setMsgError($msg)
	{
		$_SESSION[Validacao::SESSION_ERROR] = $msg;
	}

	public static function getMsgError()
	{
		$msg = (isset($_SESSION[Validacao::SESSION_ERROR])) ? $_SESSION[Validacao::SESSION_ERROR] : "";

		Validacao::clearMsgError();

		return $msg;
	}

	public static function clearMsgError()
	{
		$_SESSION[Validacao::SESSION_ERROR] = NULL;
	}

}

?>