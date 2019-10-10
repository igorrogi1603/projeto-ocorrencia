<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;

class COcorrenciaEnviarArquivo {

	public static function getEnviarArquivoCadastrar($idVitima, $idOcorrencia)
	{	
		//Recebendo dados do banco
		$dados = COcorrenciaEnviarArquivo::validacaoVitimas($idVitima, $idOcorrencia);

		//Tamanho do array dados
		$tamanhoArrayDados = count($dados) * 2;

		//pegando apenas os nomes e os id das vitimas e responsaveis
		foreach ($dados as $key => $value) {
			$arrayNome[]['nome'] = $value['nomeVitima'];
			$arrayNome[]['nome'] = $value['nomeResponsavel'];

			$arrayId[]['id'] = $value['idPessoaVitima'];
			$arrayId[]['id'] = $value['idPessoaResponsavel'];
		}

		//Junta o nome e o id de cada pessoa em um unico array
		for ($a = 0; $a < $tamanhoArrayDados; $a++) {
			$arrayPessoas[$a]['nome'] = $arrayNome[$a]['nome'];
			$arrayPessoas[$a]['id'] = $arrayId[$a]['id'];
		}

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($arrayPessoas);

		//Esse loop serve para tirar a duplicação de informação que vem do array
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($arrayPessoas[$i])) {
				//se existe guarda em id
				$id = $arrayPessoas[$i]['id'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $arrayPessoas[$a]['id']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		//exclui posissoes iguais
		foreach ($arrayPosicaoExcluir as $value) {
			unset($arrayPessoas[$value]);
		}

		return $arrayPessoas;
	}


	//------------------------------------------------------------------------------------
	//Valida todos os campos
	protected function validacaoVitimas($idVitima, $idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;
		$validacao = new Validacao;

		$vitimaOcorrencia = $mocorrencia->listaOcorrenciaVitimaCompleta($idVitima, $idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($vitimaOcorrencia);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$vitimaOcorrencia[$i]['outro'] = utf8_encode($vitimaOcorrencia[$i]['outro']);
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