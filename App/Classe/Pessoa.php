<?php

namespace App\Classe;

use \App\Config\GetSet;

class Pessoa extends GetSet {

	const SESSION_ERROR = "PessoaErro";

	//VALIDACOES 
	//****************************************************
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

	public function validarLetraAcento($variavel)
	{
		return preg_replace("/[^a-zA-Zà-úÀ-Ú\s]/", "", $variavel);
	}

	//MENSAGEM DE ERRO
	//****************************************************
	public static function setMsgError($msg)
	{
		$_SESSION[Pessoa::SESSION_ERROR] = $msg;
	}

	public static function getMsgError()
	{
		$msg = (isset($_SESSION[Pessoa::SESSION_ERROR])) ? $_SESSION[Pessoa::SESSION_ERROR] : "";

		Pessoa::clearMsgError();

		return $msg;
	}

	public static function clearMsgError()
	{
		$_SESSION[Pessoa::SESSION_ERROR] = NULL;
	}

}

?>