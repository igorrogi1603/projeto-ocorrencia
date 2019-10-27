<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MApuracao;

class COcorrenciaDescricao {

	public static function getOcorrenciaDescricao($idOcorrencia)
	{
		//instancia
		$mocorrencia = new MOcorrencia;

		//Trazer a lista completa da ocorrencia
		$listaOcorrencia = $mocorrencia->listaOcorrencia($idOcorrencia);

		$tamanhoArray = count($listaOcorrencia);

		//Nao duplicar array
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaOcorrencia[$i])) {
				//se existe guarda em id
				$id = $listaOcorrencia[$i]['idOcorrencia'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaOcorrencia[$a]['idOcorrencia']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		//exclui posissoes iguais
		foreach ($arrayPosicaoExcluir as $value) {
			unset($listaOcorrencia[$value]);
		}

		//formatando as string 
		for ($i = 0; $i < $tamanhoArray; $i++) {
			if (isset($listaOcorrencia[$i])) {
				$listaOcorrencia[$i]['descricao'] = utf8_encode($listaOcorrencia[$i]['descricao']);
				$listaOcorrencia[$i]['tipoApuracao'] = utf8_encode($listaOcorrencia[$i]['tipoApuracao']);
			}
		}

		return $listaOcorrencia;
	}

	public static function postOcorrenciaDescricaoEditar($idOcorrencia, $idApuracao, $post)
	{	
		//instancia
		$mocorrencia = new MOcorrencia;
		$mapuracao = new MApuracao;

		//validacao de campos
		if (!isset($post['tipoApuracao']) || $post['tipoApuracao'] === '') {
			Validacao::setMsgError("Informe o tipo da ocorrência.");
	        header('Location: /ocorrencia-descricao-editar/'.$idOcorrencia);
	        exit;
		}

		if (!isset($post['descricaoApuracao']) || $post['descricaoApuracao'] === '') {
			Validacao::setMsgError("Informe o descrição da ocorrência.");
	        header('Location: /ocorrencia-descricao-editar/'.$idOcorrencia);
	        exit;
		}

		//update descricao e tipo
		$mapuracao->updateDescricaoApuracao($idApuracao, $post);
	}

}

?>