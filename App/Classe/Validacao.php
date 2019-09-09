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