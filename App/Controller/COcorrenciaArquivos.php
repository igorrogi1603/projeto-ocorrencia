<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MArquivo;

class COcorrenciaArquivos {

	public static function getArquivos($idOcorrencia)
	{
		//Instancia
		$marquivo = new MArquivo;

		//Recuperando arquivos da ocorrencia em ordem crescente
		//do arquivo mais velho para o mais novo
		$listaArquivos = $marquivo->arquivosOcorencia($idOcorrencia);

		//Corrigindo acentuacao
		for ($i = 0; $i < count($listaArquivos); $i++) {
			$listaArquivos[$i]['tipo'] = $listaArquivos[$i]['tipo'];
		}

		return $listaArquivos;
	}

}

?>