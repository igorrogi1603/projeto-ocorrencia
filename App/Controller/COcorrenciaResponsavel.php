<?php

namespace App\Controller;

use \App\Model\MOcorrencia;
use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MPessoa;
use \App\Model\MResponsavel;
use \App\Classe\Ocorrencia;
use \App\Classe\Pessoa;
use \App\Classe\Endereco;
use \App\Classe\Contato;
use \App\Classe\Validacao;

class COcorrenciaResponsavel {

	public static function getListaResponsavelVitima($idVitima, $idOcorrencia)
	{
		return COcorrenciaResponsavel::validacaoVitimasEditar($idVitima, $idOcorrencia);	
	}

	public static function getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia)
	{
		return COcorrenciaResponsavel::validacaoVitimasEditar($idVitima, $idOcorrencia);
	}

	public static function postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $post)
	{
		var_dump($post);
		exit;
	}

	//Cadastrar um novo responsavel para vitima
	public static function postCadastrarResponsavelVitima($idVitima, $idOcorrencia)
	{
			
	}

	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	//Valida todos os campos
	protected function validacaoVitimasEditar($idVitima, $idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;
		$validacao = new Validacao;

		$vitimaOcorrencia = $mocorrencia->listaOcorrenciaVitimaCompleta($idVitima, $idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($vitimaOcorrencia);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$vitimaOcorrencia[$i]['descricao'] = utf8_encode($vitimaOcorrencia[$i]['descricao']);
			$vitimaOcorrencia[$i]['tipoApuracao'] = utf8_encode($vitimaOcorrencia[$i]['tipoApuracao']);
			$vitimaOcorrencia[$i]['qualFamilia'] = utf8_encode($vitimaOcorrencia[$i]['qualFamilia']);
			$vitimaOcorrencia[$i]['nomeVitima'] = utf8_encode($vitimaOcorrencia[$i]['nomeVitima']);
			$vitimaOcorrencia[$i]['nomeResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['nomeResponsavel']);
			$vitimaOcorrencia[$i]['ruaVitima'] = utf8_encode($vitimaOcorrencia[$i]['ruaVitima']);
			$vitimaOcorrencia[$i]['bairroVitima'] = utf8_encode($vitimaOcorrencia[$i]['bairroVitima']);
			$vitimaOcorrencia[$i]['cidadeVitima'] = utf8_encode($vitimaOcorrencia[$i]['cidadeVitima']);
			$vitimaOcorrencia[$i]['estadoVitima'] = strtoupper(utf8_encode($vitimaOcorrencia[$i]['estadoVitima']));
			$vitimaOcorrencia[$i]['complementoVitima'] = utf8_encode($vitimaOcorrencia[$i]['complementoVitima']);
			$vitimaOcorrencia[$i]['ruaResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['ruaResponsavel']);
			$vitimaOcorrencia[$i]['bairroResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['bairroResponsavel']);
			$vitimaOcorrencia[$i]['cidadeResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['cidadeResponsavel']);
			$vitimaOcorrencia[$i]['estadoResponsavel'] = strtoupper(utf8_encode($vitimaOcorrencia[$i]['estadoResponsavel']));
			$vitimaOcorrencia[$i]['complementoResponsavel'] = utf8_encode($vitimaOcorrencia[$i]['complementoResponsavel']);
			$vitimaOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($vitimaOcorrencia[$i]['cpfVitima']));
			$vitimaOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($vitimaOcorrencia[$i]['celularVitima']));
			$vitimaOcorrencia[$i]['fixoVitima'] = $validacao->replaceTelefoneFixoView(utf8_encode($vitimaOcorrencia[$i]['fixoVitima']));
			$vitimaOcorrencia[$i]['fixoResponsavel'] = $validacao->replaceTelefoneFixoView(utf8_encode($vitimaOcorrencia[$i]['fixoResponsavel']));
			$vitimaOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($vitimaOcorrencia[$i]['cpfResponsavel']));
			$vitimaOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($vitimaOcorrencia[$i]['celularResponsavel']));
			$vitimaOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($vitimaOcorrencia[$i]['cepVitima']));
			$vitimaOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($vitimaOcorrencia[$i]['cepResponsavel']));
			$vitimaOcorrencia[$i]['rgVitimaDigito'] = $validacao->replaceDigitoRg($vitimaOcorrencia[$i]['rgVitima']);
			$vitimaOcorrencia[$i]['rgVitima'] = $validacao->replaceSemDigitoRg($vitimaOcorrencia[$i]['rgVitima']);
			$vitimaOcorrencia[$i]['rgResponsavelDigito'] = $validacao->replaceDigitoRg($vitimaOcorrencia[$i]['rgResponsavel']);
			$vitimaOcorrencia[$i]['rgResponsavel'] = $validacao->replaceSemDigitoRg($vitimaOcorrencia[$i]['rgResponsavel']);
			$vitimaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataRegistroOcorrencia']));
			$vitimaOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataCriacaoOcorrencia']));

			if ($vitimaOcorrencia[$i]['dataNascVitima'] == null) {
				//mostra nada
			} else {
				$vitimaOcorrencia[$i]['dataNascVitima'] = $validacao->replaceDataView(utf8_encode($vitimaOcorrencia[$i]['dataNascVitima']));
			}
		}
		return $vitimaOcorrencia;
	}

}
?>