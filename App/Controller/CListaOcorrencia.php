<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;

class CListaOcorrencia {

	public static function getListaOcorrencia()
	{
		$mocorrencia = new MOcorrencia;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$listaOcorrencia = $mocorrencia->listaOcorrenciaCompleta();

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaOcorrencia);

		//Esse loop serve para tirar a duplicação de informação que vem do banco
		//Pois se tiver duas ou mais vitimas vinculada a apuracao entao ele se duplica
		//E para exibir essa lista nao pode repetir por isso excluir os dados repetidos
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

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaOcorrencia[$i])) {
				$listaOcorrencia[$i]['descricao'] = utf8_encode($listaOcorrencia[$i]['descricao']);
				$listaOcorrencia[$i]['tipoApuracao'] = utf8_encode($listaOcorrencia[$i]['tipoApuracao']);
				$listaOcorrencia[$i]['qualFamilia'] = utf8_encode($listaOcorrencia[$i]['qualFamilia']);
				$listaOcorrencia[$i]['nomeVitima'] = utf8_encode($listaOcorrencia[$i]['nomeVitima']);
				$listaOcorrencia[$i]['nomeResponsavel'] = utf8_encode($listaOcorrencia[$i]['nomeResponsavel']);
				$listaOcorrencia[$i]['ruaVitima'] = utf8_encode($listaOcorrencia[$i]['ruaVitima']);
				$listaOcorrencia[$i]['bairroVitima'] = utf8_encode($listaOcorrencia[$i]['bairroVitima']);
				$listaOcorrencia[$i]['cidadeVitima'] = utf8_encode($listaOcorrencia[$i]['cidadeVitima']);
				$listaOcorrencia[$i]['estadoVitima'] = strtoupper(utf8_encode($listaOcorrencia[$i]['estadoVitima']));
				$listaOcorrencia[$i]['complementoVitima'] = utf8_encode($listaOcorrencia[$i]['complementoVitima']);
				$listaOcorrencia[$i]['ruaResponsavel'] = utf8_encode($listaOcorrencia[$i]['ruaResponsavel']);
				$listaOcorrencia[$i]['bairroResponsavel'] = utf8_encode($listaOcorrencia[$i]['bairroResponsavel']);
				$listaOcorrencia[$i]['cidadeResponsavel'] = utf8_encode($listaOcorrencia[$i]['cidadeResponsavel']);
				$listaOcorrencia[$i]['estadoResponsavel'] = strtoupper(utf8_encode($listaOcorrencia[$i]['estadoResponsavel']));
				$listaOcorrencia[$i]['complementoResponsavel'] = utf8_encode($listaOcorrencia[$i]['complementoResponsavel']);
				$listaOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($listaOcorrencia[$i]['cpfVitima']));
				$listaOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($listaOcorrencia[$i]['celularVitima']));
				$listaOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($listaOcorrencia[$i]['cpfResponsavel']));
				$listaOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($listaOcorrencia[$i]['celularResponsavel']));
				$listaOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($listaOcorrencia[$i]['cepVitima']));
				$listaOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($listaOcorrencia[$i]['cepResponsavel']));
				$listaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($listaOcorrencia[$i]['dataRegistroOcorrencia']));
				$listaOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView(utf8_encode($listaOcorrencia[$i]['dataCriacaoOcorrencia']));
			}
		}
		return $listaOcorrencia;
	}

}

?>