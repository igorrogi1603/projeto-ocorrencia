<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;

class CDetalheOcorrencia {

	public function getOcorrenciaDetalhe($idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;
		$validacao = new Validacao;

		$detalheOcorrencia = $mocorrencia->listaOcorrencia($idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheOcorrencia);

		//Nao duplicar array
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($detalheOcorrencia[$i])) {
				//se existe guarda em id
				$id = $detalheOcorrencia[$i]['idPessoaVitima'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $detalheOcorrencia[$a]['idPessoaVitima']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($detalheOcorrencia[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			if (isset($detalheOcorrencia[$i])) {
				$detalheOcorrencia[$i]['outro'] = $detalheOcorrencia[$i]['outro'];
				$detalheOcorrencia[$i]['descricao'] = $detalheOcorrencia[$i]['descricao'];
				$detalheOcorrencia[$i]['tipoApuracao'] = $detalheOcorrencia[$i]['tipoApuracao'];
				$detalheOcorrencia[$i]['qualFamilia'] = $detalheOcorrencia[$i]['qualFamilia'];
				$detalheOcorrencia[$i]['nomeVitima'] = $detalheOcorrencia[$i]['nomeVitima'];
				$detalheOcorrencia[$i]['nomeResponsavel'] = $detalheOcorrencia[$i]['nomeResponsavel'];
				$detalheOcorrencia[$i]['ruaVitima'] = $detalheOcorrencia[$i]['ruaVitima'];
				$detalheOcorrencia[$i]['bairroVitima'] = $detalheOcorrencia[$i]['bairroVitima'];
				$detalheOcorrencia[$i]['cidadeVitima'] = $detalheOcorrencia[$i]['cidadeVitima'];
				$detalheOcorrencia[$i]['estadoVitima'] = strtoupper($detalheOcorrencia[$i]['estadoVitima']);
				$detalheOcorrencia[$i]['complementoVitima'] = $detalheOcorrencia[$i]['complementoVitima'];
				$detalheOcorrencia[$i]['ruaResponsavel'] = $detalheOcorrencia[$i]['ruaResponsavel'];
				$detalheOcorrencia[$i]['bairroResponsavel'] = $detalheOcorrencia[$i]['bairroResponsavel'];
				$detalheOcorrencia[$i]['cidadeResponsavel'] = $detalheOcorrencia[$i]['cidadeResponsavel'];
				$detalheOcorrencia[$i]['estadoResponsavel'] = strtoupper($detalheOcorrencia[$i]['estadoResponsavel']);
				$detalheOcorrencia[$i]['complementoResponsavel'] = $detalheOcorrencia[$i]['complementoResponsavel'];
				$detalheOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView($detalheOcorrencia[$i]['cpfVitima']);
				$detalheOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView($detalheOcorrencia[$i]['celularVitima']);
				$detalheOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView($detalheOcorrencia[$i]['cpfResponsavel']);
				$detalheOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView($detalheOcorrencia[$i]['celularResponsavel']);
				$detalheOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView($detalheOcorrencia[$i]['cepVitima']);
				$detalheOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView($detalheOcorrencia[$i]['cepResponsavel']);
				$detalheOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView($detalheOcorrencia[$i]['dataRegistroOcorrencia']);
				$detalheOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView($detalheOcorrencia[$i]['dataCriacaoOcorrencia']);
			}
		}
		return $detalheOcorrencia;
	}

}

?>