<?php

namespace App\Controller;

use \App\Classe\Agressor;
use \App\Classe\Validacao;
use \App\Model\MAgressor;
use \App\Model\MInstituicao;

class COcorrenciaAgressor {

	public static function getListaAgressor($idOcorrencia)
	{
		//Reucperando os array ja formatados
		$listaAgressor = COcorrenciaAgressor::listaAgressor($idOcorrencia);
		$listaInstituicao = COcorrenciaAgressor::listaInstituicao($idOcorrencia);

		//Pegar tamanho do array
		$tamanhoArrayAgressor = count($listaAgressor);
		$tamanhoArrayInstituicao = count($listaInstituicao);

		//se CPF ou CNPJ
		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			$listaAgressor[$i]['isCpf'] = '1';
		}

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			$listaInstituicao[$i]['isCpf'] = '0';
		}

		//Juntando os dois arary
		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			$listaCompleta[] = $listaAgressor[$i];
		}

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			$listaCompleta[] = $listaInstituicao[$i];
		}

		return $listaCompleta;
	}

	public static function getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao)
	{	
		//Verificar se e instituicao ou pessoa fisica
		if ($isInstituicao == "0") {
			$listaAgressor = COcorrenciaAgressor::listaAgressor($idOcorrencia, "unico", $idOcorrenciaAgressor);	
		}

		if ($isInstituicao == "1") {
			$listaAgressor = COcorrenciaAgressor::listaInstituicao($idOcorrencia, "unico", $idOcorrenciaAgressor);
		}
		
		return $listaAgressor;
	}

	protected function listaAgressor($idOcorrencia, $complemento = "completo", $idOcorrenciaAgressor = "")
	{
		//Instancia
		$magressor = new MAgressor;
		$validacao = new Validacao;

		//Recuperando dados
		if ($complemento == "unico") {
			$listaAgressor = $magressor->listaAgressorEspecifico($idOcorrencia, $idOcorrenciaAgressor);
		}

		if ($complemento == "completo") {
			$listaAgressor = $magressor->listaAgressor($idOcorrencia);
		}

		//Tamanho do array
		$tamanhoArrayAgressor = count($listaAgressor);

		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			$listaAgressor[$i]['nome'] = utf8_encode($listaAgressor[$i]['nome']);
			$listaAgressor[$i]['rua'] = utf8_encode($listaAgressor[$i]['rua']);
			$listaAgressor[$i]['bairro'] = utf8_encode($listaAgressor[$i]['bairro']);
			$listaAgressor[$i]['cidade'] = utf8_encode($listaAgressor[$i]['cidade']);
			$listaAgressor[$i]['complemento'] = utf8_encode($listaAgressor[$i]['complemento']);
			$listaAgressor[$i]['celular'] = $validacao->replaceCelularView(utf8_encode($listaAgressor[$i]['celular']));
			$listaAgressor[$i]['fixo'] = $validacao->replaceTelefoneFixoView(utf8_encode($listaAgressor[$i]['fixo']));
			$listaAgressor[$i]['cpf'] = $validacao->replaceCpfView(utf8_encode($listaAgressor[$i]['cpf']));
			$listaAgressor[$i]['rg'] = $validacao->replaceSemDigitoRg($listaAgressor[$i]['rg']);

			if ($listaAgressor[$i]['dataNasc'] == null) {
				//mostra nada
			} else {
				$listaAgressor[$i]['dataNasc'] = $validacao->replaceDataView(utf8_encode($listaAgressor[$i]['dataNasc']));
			}
		}

		return $listaAgressor;
	}

	protected function listaInstituicao($idOcorrencia, $complemento = "completo", $idOcorrenciaAgressor = "")
	{
		//Instancia
		$minstituicao = new MInstituicao;
		$validacao = new Validacao;

		//Recuperando dados
		if ($complemento == "unico") {
			$listaInstituicao = $minstituicao->listaInstituicaoEspecifica($idOcorrencia, $idOcorrenciaAgressor);
		}

		if ($complemento == "completo") {
			$listaInstituicao = $minstituicao->listaInstituicao($idOcorrencia);
		}

		//Tamanho do array
		$tamanhoArrayInstituicao = count($listaInstituicao);

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			$listaInstituicao[$i]['nome'] = utf8_encode($listaInstituicao[$i]['nome']);
			$listaInstituicao[$i]['rua'] = utf8_encode($listaInstituicao[$i]['rua']);
			$listaInstituicao[$i]['bairro'] = utf8_encode($listaInstituicao[$i]['bairro']);
			$listaInstituicao[$i]['cidade'] = utf8_encode($listaInstituicao[$i]['cidade']);
			$listaInstituicao[$i]['complemento'] = utf8_encode($listaInstituicao[$i]['complemento']);
			$listaInstituicao[$i]['celular'] = $validacao->replaceCelularView(utf8_encode($listaInstituicao[$i]['celular']));
			$listaInstituicao[$i]['fixo'] = $validacao->replaceTelefoneFixoView(utf8_encode($listaInstituicao[$i]['fixo']));
			$listaInstituicao[$i]['cnpj'] = $validacao->replaceCnpjView(utf8_encode($listaInstituicao[$i]['cnpj']));
		}

		return $listaInstituicao;
	}

}

?>