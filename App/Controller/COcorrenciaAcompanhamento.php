<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MAcompanhamento;

class COcorrenciaAcompanhamento {

	public static function getOcorrenciaAcompanhamento($idVitima)
	{
		$macompanhamento = new MAcompanhamento;
		$validacao = new Validacao;

		$listaAcompanhamentoGeral = $macompanhamento->listaAcompanhamentoGeral($idVitima);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaAcompanhamentoGeral);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$listaAcompanhamentoGeral[$i]['rua'] = $listaAcompanhamentoGeral[$i]['rua'];
			$listaAcompanhamentoGeral[$i]['bairro'] = $listaAcompanhamentoGeral[$i]['bairro'];
			$listaAcompanhamentoGeral[$i]['cidade'] = $listaAcompanhamentoGeral[$i]['cidade'];
			$listaAcompanhamentoGeral[$i]['estado'] = strtoupper($listaAcompanhamentoGeral[$i]['estado']);
			$listaAcompanhamentoGeral[$i]['complemento'] = $listaAcompanhamentoGeral[$i]['complemento'];
			$listaAcompanhamentoGeral[$i]['cep'] = $validacao->replaceCepView($listaAcompanhamentoGeral[$i]['cep']);
			$listaAcompanhamentoGeral[$i]['data'] = $validacao->replaceDataView($listaAcompanhamentoGeral[$i]['dataRegistro']);
			$listaAcompanhamentoGeral[$i]['hora'] = $validacao->replaceHoraView($listaAcompanhamentoGeral[$i]['dataRegistro']);
		}

		return $listaAcompanhamentoGeral;
	}

}

?>