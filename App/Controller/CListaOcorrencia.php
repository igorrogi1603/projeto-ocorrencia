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

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaOcorrencia[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaOcorrencia[$i])) {
				$listaOcorrencia[$i]['descricao'] = $listaOcorrencia[$i]['descricao'];
				$listaOcorrencia[$i]['tipoApuracao'] = $listaOcorrencia[$i]['tipoApuracao'];
				$listaOcorrencia[$i]['qualFamilia'] = $listaOcorrencia[$i]['qualFamilia'];
				$listaOcorrencia[$i]['nomeVitima'] = $listaOcorrencia[$i]['nomeVitima'];
				$listaOcorrencia[$i]['nomeResponsavel'] = $listaOcorrencia[$i]['nomeResponsavel'];
				$listaOcorrencia[$i]['ruaVitima'] = $listaOcorrencia[$i]['ruaVitima'];
				$listaOcorrencia[$i]['bairroVitima'] = $listaOcorrencia[$i]['bairroVitima'];
				$listaOcorrencia[$i]['cidadeVitima'] = $listaOcorrencia[$i]['cidadeVitima'];
				$listaOcorrencia[$i]['estadoVitima'] = strtoupper($listaOcorrencia[$i]['estadoVitima']);
				$listaOcorrencia[$i]['complementoVitima'] = $listaOcorrencia[$i]['complementoVitima'];
				$listaOcorrencia[$i]['ruaResponsavel'] = $listaOcorrencia[$i]['ruaResponsavel'];
				$listaOcorrencia[$i]['bairroResponsavel'] = $listaOcorrencia[$i]['bairroResponsavel'];
				$listaOcorrencia[$i]['cidadeResponsavel'] = $listaOcorrencia[$i]['cidadeResponsavel'];
				$listaOcorrencia[$i]['estadoResponsavel'] = strtoupper($listaOcorrencia[$i]['estadoResponsavel']);
				$listaOcorrencia[$i]['complementoResponsavel'] = $listaOcorrencia[$i]['complementoResponsavel'];
				$listaOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView($listaOcorrencia[$i]['cpfVitima']);
				$listaOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView($listaOcorrencia[$i]['celularVitima']);
				$listaOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView($listaOcorrencia[$i]['cpfResponsavel']);
				$listaOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView($listaOcorrencia[$i]['celularResponsavel']);
				$listaOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView($listaOcorrencia[$i]['cepVitima']);
				$listaOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView($listaOcorrencia[$i]['cepResponsavel']);
				$listaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView($listaOcorrencia[$i]['dataRegistroOcorrencia']);
				$listaOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView($listaOcorrencia[$i]['dataCriacaoOcorrencia']);
			}
		}
		return $listaOcorrencia;
	}

	////////////////////////////////////////////////////////////////////////////////

	public static function listaBloquearOcorrenciaUsuario($idUsuario)
	{	
		$mocorrencia = new MOcorrencia;

		return $mocorrencia->listaBloquearOcorrenciaUsuario($idUsuario);
	}

	public static function listaBloquearOcorrenciaApuracao($idApuracao)
	{	
		$mocorrencia = new MOcorrencia;

		return $mocorrencia->listaBloquearOcorrenciaApuracao($idApuracao);
	}

	public static function listaBloquearOcorrencia($idOcorrencia)
	{	
		$mocorrencia = new MOcorrencia;

		return $mocorrencia->listaBloquearOcorrencia($idOcorrencia);
	}

}

?>