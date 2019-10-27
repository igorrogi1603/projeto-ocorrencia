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

		//exclui posissoes iguais
		foreach ($arrayPosicaoExcluir as $value) {
			unset($detalheOcorrencia[$value]);
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			if (isset($detalheOcorrencia[$i])) {
				$detalheOcorrencia[$i]['outro'] = utf8_encode($detalheOcorrencia[$i]['outro']);
				$detalheOcorrencia[$i]['descricao'] = utf8_encode($detalheOcorrencia[$i]['descricao']);
				$detalheOcorrencia[$i]['tipoApuracao'] = utf8_encode($detalheOcorrencia[$i]['tipoApuracao']);
				$detalheOcorrencia[$i]['qualFamilia'] = utf8_encode($detalheOcorrencia[$i]['qualFamilia']);
				$detalheOcorrencia[$i]['nomeVitima'] = utf8_encode($detalheOcorrencia[$i]['nomeVitima']);
				$detalheOcorrencia[$i]['nomeResponsavel'] = utf8_encode($detalheOcorrencia[$i]['nomeResponsavel']);
				$detalheOcorrencia[$i]['ruaVitima'] = utf8_encode($detalheOcorrencia[$i]['ruaVitima']);
				$detalheOcorrencia[$i]['bairroVitima'] = utf8_encode($detalheOcorrencia[$i]['bairroVitima']);
				$detalheOcorrencia[$i]['cidadeVitima'] = utf8_encode($detalheOcorrencia[$i]['cidadeVitima']);
				$detalheOcorrencia[$i]['estadoVitima'] = strtoupper(utf8_encode($detalheOcorrencia[$i]['estadoVitima']));
				$detalheOcorrencia[$i]['complementoVitima'] = utf8_encode($detalheOcorrencia[$i]['complementoVitima']);
				$detalheOcorrencia[$i]['ruaResponsavel'] = utf8_encode($detalheOcorrencia[$i]['ruaResponsavel']);
				$detalheOcorrencia[$i]['bairroResponsavel'] = utf8_encode($detalheOcorrencia[$i]['bairroResponsavel']);
				$detalheOcorrencia[$i]['cidadeResponsavel'] = utf8_encode($detalheOcorrencia[$i]['cidadeResponsavel']);
				$detalheOcorrencia[$i]['estadoResponsavel'] = strtoupper(utf8_encode($detalheOcorrencia[$i]['estadoResponsavel']));
				$detalheOcorrencia[$i]['complementoResponsavel'] = utf8_encode($detalheOcorrencia[$i]['complementoResponsavel']);
				$detalheOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($detalheOcorrencia[$i]['cpfVitima']));
				$detalheOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($detalheOcorrencia[$i]['celularVitima']));
				$detalheOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($detalheOcorrencia[$i]['cpfResponsavel']));
				$detalheOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($detalheOcorrencia[$i]['celularResponsavel']));
				$detalheOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($detalheOcorrencia[$i]['cepVitima']));
				$detalheOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($detalheOcorrencia[$i]['cepResponsavel']));
				$detalheOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($detalheOcorrencia[$i]['dataRegistroOcorrencia']));
				$detalheOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView(utf8_encode($detalheOcorrencia[$i]['dataCriacaoOcorrencia']));
			}
		}
		return $detalheOcorrencia;
	}

}

?>