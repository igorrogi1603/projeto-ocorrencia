<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MPessoa;
use \App\Model\MContato;
use \App\Model\MEndereco;

class COcorrenciaVitima {

	public static function postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $post)
	{
		$mpessoa = new MPessoa;
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$validacao = new Validacao;

		$vitima = COcorrenciaVitima::validacaoVitimasEditar($idVitima, $idOcorrencia);	

		$idContato = $vitima[0]['idContatoVitima'];
		$idEndereco = $vitima[0]['idEnderecoVitima'];

		//Validacoes de Campo
		//--------------------------------------------------------------------------------------
		$post['nomeVitima'] = $validacao->validarString($post['nomeVitima'], 1);
		$validaCPF = $validacao->validaCPF($post['cpfVitima']);
		$post['cepVitima'] = $validacao->validarString($post['cepVitima'], 3);
		$post['ruaVitima'] = $validacao->validarString($post['ruaVitima'], 2);
		$post['bairroVitima'] = $validacao->validarString($post['bairroVitima'], 2);
		$post['numeroVitima'] = $validacao->validarString($post['numeroVitima'], 3);
		$post['cidadeVitima'] = $validacao->validarString($post['cidadeVitima'], 1);
		$post['complementoVitima'] = $validacao->validarString($post['complementoVitima'], 2);

		if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
			Validacao::setMsgError("CPF Inválido.");
	        header('Location: /ocorrencia-vitima-editar/'.$idVitima.'/'.$idOcorrencia);
	        exit;
		}

		if (!isset($post['nomeVitima']) || $post['nomeVitima'] === '') {
			Validacao::setMsgError("Informe o Nome da Vítima.");
	        header('Location: /ocorrencia-vitima-editar/'.$idVitima.'/'.$idOcorrencia);
	        exit;
		}

		//Nao pode cadastrar pessoas com cpf iguais
		//Pelo cpf da para saber se tem duas pessoas com mais de um registro
		$cpfIgual = $mpessoa->cpfIgualUpdate($idPessoa);

		foreach ($cpfIgual as $cpf) {
			if ($validacao->replaceCpfBd($post['cpfVitima']) == $cpf['cpf']) {
				Validacao::setMsgError("Este cpf já está cadastrado.");
		        header('Location: /ocorrencia-vitima-editar/'.$idVitima.'/'.$idOcorrencia);
		        exit;
			}
		}

		$mpessoa->update($post, $idPessoa, 'vitima');
		$mcontato->update($post, $idContato, 'vitima');
		$mendereco->update($post, $idEndereco, 'vitima');
	}

	public static function getOcorrenciaVitimaEditar($idVitima, $idOcorrencia)
	{
		return COcorrenciaVitima::validacaoVitimasEditar($idVitima, $idOcorrencia);
	}

	public static function getOcorrenciaVitima($idOcorrencia)
	{	
		//Recupera a lista com os dados da vitima
		$listaVitimas = COcorrenciaVitima::validacaoListaVitimas($idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaVitimas);

		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaVitimas[$i])) {
				//se existe guarda em id
				$id = $listaVitimas[$i]['idPessoaVitima'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaVitimas[$a]['idPessoaVitima']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		//exclui posissoes iguais
		foreach ($arrayPosicaoExcluir as $value) {
			unset($listaVitimas[$value]);
		}

		return $listaVitimas;
	}

	public static function getOcorrenciaVitimasLista($idOcorrencia)
	{	
		//Recupera a lista com os dados da vitima
		$listaVitimas = COcorrenciaVitima::validacaoListaVitimas($idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaVitimas);

		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaVitimas[$i])) {
				//se existe guarda em id
				$id = $listaVitimas[$i]['idPessoaVitima'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaVitimas[$a]['idPessoaVitima']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		//exclui posissoes iguais
		foreach ($arrayPosicaoExcluir as $value) {
			unset($listaVitimas[$value]);
		}

		return $listaVitimas;
	}


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

	//------------------------------------------------------------------------------------
	//Valida todos os campos
	protected function validacaoListaVitimas($idOcorrencia)
	{
		$mocorrencia = new MOcorrencia;
		$validacao = new Validacao;

		$vitimasOcorrencia = $mocorrencia->listaOcorrencia($idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($vitimasOcorrencia);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$vitimasOcorrencia[$i]['descricao'] = utf8_encode($vitimasOcorrencia[$i]['descricao']);
			$vitimasOcorrencia[$i]['tipoApuracao'] = utf8_encode($vitimasOcorrencia[$i]['tipoApuracao']);
			$vitimasOcorrencia[$i]['qualFamilia'] = utf8_encode($vitimasOcorrencia[$i]['qualFamilia']);
			$vitimasOcorrencia[$i]['nomeVitima'] = utf8_encode($vitimasOcorrencia[$i]['nomeVitima']);
			$vitimasOcorrencia[$i]['nomeResponsavel'] = utf8_encode($vitimasOcorrencia[$i]['nomeResponsavel']);
			$vitimasOcorrencia[$i]['ruaVitima'] = utf8_encode($vitimasOcorrencia[$i]['ruaVitima']);
			$vitimasOcorrencia[$i]['bairroVitima'] = utf8_encode($vitimasOcorrencia[$i]['bairroVitima']);
			$vitimasOcorrencia[$i]['cidadeVitima'] = utf8_encode($vitimasOcorrencia[$i]['cidadeVitima']);
			$vitimasOcorrencia[$i]['estadoVitima'] = strtoupper(utf8_encode($vitimasOcorrencia[$i]['estadoVitima']));
			$vitimasOcorrencia[$i]['complementoVitima'] = utf8_encode($vitimasOcorrencia[$i]['complementoVitima']);
			$vitimasOcorrencia[$i]['ruaResponsavel'] = utf8_encode($vitimasOcorrencia[$i]['ruaResponsavel']);
			$vitimasOcorrencia[$i]['bairroResponsavel'] = utf8_encode($vitimasOcorrencia[$i]['bairroResponsavel']);
			$vitimasOcorrencia[$i]['cidadeResponsavel'] = utf8_encode($vitimasOcorrencia[$i]['cidadeResponsavel']);
			$vitimasOcorrencia[$i]['estadoResponsavel'] = strtoupper(utf8_encode($vitimasOcorrencia[$i]['estadoResponsavel']));
			$vitimasOcorrencia[$i]['complementoResponsavel'] = utf8_encode($vitimasOcorrencia[$i]['complementoResponsavel']);
			$vitimasOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($vitimasOcorrencia[$i]['cpfVitima']));
			$vitimasOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($vitimasOcorrencia[$i]['celularVitima']));
			$vitimasOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($vitimasOcorrencia[$i]['cpfResponsavel']));
			$vitimasOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($vitimasOcorrencia[$i]['celularResponsavel']));
			$vitimasOcorrencia[$i]['fixoVitima'] = $validacao->replaceTelefoneFixoView(utf8_encode($vitimasOcorrencia[$i]['fixoVitima']));
			$vitimasOcorrencia[$i]['fixoResponsavel'] = $validacao->replaceTelefoneFixoView(utf8_encode($vitimasOcorrencia[$i]['fixoResponsavel']));
			$vitimasOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($vitimasOcorrencia[$i]['cepVitima']));
			$vitimasOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($vitimasOcorrencia[$i]['cepResponsavel']));
			$vitimasOcorrencia[$i]['rgVitima'] = $validacao->replaceRgView($vitimasOcorrencia[$i]['rgVitima']);
			$vitimasOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimasOcorrencia[$i]['dataRegistroOcorrencia']));
			$vitimasOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView(utf8_encode($vitimasOcorrencia[$i]['dataCriacaoOcorrencia']));

			if ($vitimasOcorrencia[$i]['dataNascVitima'] == null) {
				//mostra nada
			} else {
				$vitimasOcorrencia[$i]['dataNascVitima'] = $validacao->replaceDataView(utf8_encode($vitimasOcorrencia[$i]['dataNascVitima']));
			}
		}
		return $vitimasOcorrencia;
	}

}

?>