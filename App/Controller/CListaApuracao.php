<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;

class CListaApuracao {

	public static function getGerarOcorrencia($idApuracao)
	{
		$mapuracao = new MApuracao;

		$mapuracao->confirmacaoApuracao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario'], 1, 0);

		$mapuracao->updateStatus(2, $idApuracao);

		$mapuracao->gerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);
	}

	public static function postDescartarApuracao($post, $idApuracao)
	{
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		$mapuracao->apuracaoExcluida($post, $idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);

		$mapuracao->updateStatus(4, $idApuracao);
	}

	public static function getApuracaoDetalhe($idApuracao)
	{
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$detalheApuracao = $mapuracao->listApuracao($idApuracao);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheApuracao);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$detalheApuracao[$i]['descricao'] = utf8_encode($detalheApuracao[$i]['descricao']);
			$detalheApuracao[$i]['tipoApuracao'] = utf8_encode($detalheApuracao[$i]['tipoApuracao']);
			$detalheApuracao[$i]['qualFamilia'] = utf8_encode($detalheApuracao[$i]['qualFamilia']);
			$detalheApuracao[$i]['nomeVitima'] = utf8_encode($detalheApuracao[$i]['nomeVitima']);
			$detalheApuracao[$i]['nomeResponsavel'] = utf8_encode($detalheApuracao[$i]['nomeResponsavel']);
			$detalheApuracao[$i]['ruaVitima'] = utf8_encode($detalheApuracao[$i]['ruaVitima']);
			$detalheApuracao[$i]['bairroVitima'] = utf8_encode($detalheApuracao[$i]['bairroVitima']);
			$detalheApuracao[$i]['cidadeVitima'] = utf8_encode($detalheApuracao[$i]['cidadeVitima']);
			$detalheApuracao[$i]['estadoVitima'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoVitima']));
			$detalheApuracao[$i]['complementoVitima'] = utf8_encode($detalheApuracao[$i]['complementoVitima']);
			$detalheApuracao[$i]['ruaResponsavel'] = utf8_encode($detalheApuracao[$i]['ruaResponsavel']);
			$detalheApuracao[$i]['bairroResponsavel'] = utf8_encode($detalheApuracao[$i]['bairroResponsavel']);
			$detalheApuracao[$i]['cidadeResponsavel'] = utf8_encode($detalheApuracao[$i]['cidadeResponsavel']);
			$detalheApuracao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoResponsavel']));
			$detalheApuracao[$i]['complementoResponsavel'] = utf8_encode($detalheApuracao[$i]['complementoResponsavel']);
			$detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfVitima']));
			$detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularVitima']));
			$detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfResponsavel']));
			$detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularResponsavel']));
			$detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepVitima']));
			$detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepResponsavel']));
			$detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($detalheApuracao[$i]['dataRegistro']));
			$detalheApuracao[$i]['quemCriouApuracao'] = utf8_encode($detalheApuracao[$i]['quemCriouApuracao']);
		}
		
		return $detalheApuracao;
	}

	public static function getListaApuracao()
	{	
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$listaApuracao = $mapuracao->listApuracaoCompleta();

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaApuracao);

		//Esse loop serve para tirar a duplicação de informação que vem do banco
		//Pois se tiver duas ou mais vitimas vinculada a apuracao entao ele se duplica
		//E para exibir essa lista nao pode repetir por isso excluir os dados repetidos
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaApuracao[$i])) {
				//se existe guarda em id
				$id = $listaApuracao[$i]['idCriarApuracao'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaApuracao[$a]['idCriarApuracao']) {
					unset($listaApuracao[$a]);
				}
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaApuracao[$i])) {
				$listaApuracao[$i]['descricao'] = utf8_encode($listaApuracao[$i]['descricao']);
				$listaApuracao[$i]['tipoApuracao'] = utf8_encode($listaApuracao[$i]['tipoApuracao']);
				$listaApuracao[$i]['qualFamilia'] = utf8_encode($listaApuracao[$i]['qualFamilia']);
				$listaApuracao[$i]['nomeVitima'] = utf8_encode($listaApuracao[$i]['nomeVitima']);
				$listaApuracao[$i]['nomeResponsavel'] = utf8_encode($listaApuracao[$i]['nomeResponsavel']);
				$listaApuracao[$i]['ruaVitima'] = utf8_encode($listaApuracao[$i]['ruaVitima']);
				$listaApuracao[$i]['bairroVitima'] = utf8_encode($listaApuracao[$i]['bairroVitima']);
				$listaApuracao[$i]['cidadeVitima'] = utf8_encode($listaApuracao[$i]['cidadeVitima']);
				$listaApuracao[$i]['estadoVitima'] = strtoupper(utf8_encode($listaApuracao[$i]['estadoVitima']));
				$listaApuracao[$i]['complementoVitima'] = utf8_encode($listaApuracao[$i]['complementoVitima']);
				$listaApuracao[$i]['ruaResponsavel'] = utf8_encode($listaApuracao[$i]['ruaResponsavel']);
				$listaApuracao[$i]['bairroResponsavel'] = utf8_encode($listaApuracao[$i]['bairroResponsavel']);
				$listaApuracao[$i]['cidadeResponsavel'] = utf8_encode($listaApuracao[$i]['cidadeResponsavel']);
				$listaApuracao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($listaApuracao[$i]['estadoResponsavel']));
				$listaApuracao[$i]['complementoResponsavel'] = utf8_encode($listaApuracao[$i]['complementoResponsavel']);
				$listaApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($listaApuracao[$i]['cpfVitima']));
				$listaApuracao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($listaApuracao[$i]['celularVitima']));
				$listaApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($listaApuracao[$i]['cpfResponsavel']));
				$listaApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($listaApuracao[$i]['celularResponsavel']));
				$listaApuracao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($listaApuracao[$i]['cepVitima']));
				$listaApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($listaApuracao[$i]['cepResponsavel']));
				$listaApuracao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($listaApuracao[$i]['dataRegistro']));
			}
		}

		return $listaApuracao;
	}

	//----------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------------------------
	//CONFIRMACAO
	//----------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------------------------

	public static function getConfirmacaoDetalhe($idApuracao)
	{
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$detalheApuracao = $mapuracao->listApuracao($idApuracao);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheApuracao);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$detalheApuracao[$i]['descricao'] = utf8_encode($detalheApuracao[$i]['descricao']);
			$detalheApuracao[$i]['tipoApuracao'] = utf8_encode($detalheApuracao[$i]['tipoApuracao']);
			$detalheApuracao[$i]['qualFamilia'] = utf8_encode($detalheApuracao[$i]['qualFamilia']);
			$detalheApuracao[$i]['nomeVitima'] = utf8_encode($detalheApuracao[$i]['nomeVitima']);
			$detalheApuracao[$i]['nomeResponsavel'] = utf8_encode($detalheApuracao[$i]['nomeResponsavel']);
			$detalheApuracao[$i]['ruaVitima'] = utf8_encode($detalheApuracao[$i]['ruaVitima']);
			$detalheApuracao[$i]['bairroVitima'] = utf8_encode($detalheApuracao[$i]['bairroVitima']);
			$detalheApuracao[$i]['cidadeVitima'] = utf8_encode($detalheApuracao[$i]['cidadeVitima']);
			$detalheApuracao[$i]['estadoVitima'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoVitima']));
			$detalheApuracao[$i]['complementoVitima'] = utf8_encode($detalheApuracao[$i]['complementoVitima']);
			$detalheApuracao[$i]['ruaResponsavel'] = utf8_encode($detalheApuracao[$i]['ruaResponsavel']);
			$detalheApuracao[$i]['bairroResponsavel'] = utf8_encode($detalheApuracao[$i]['bairroResponsavel']);
			$detalheApuracao[$i]['cidadeResponsavel'] = utf8_encode($detalheApuracao[$i]['cidadeResponsavel']);
			$detalheApuracao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($detalheApuracao[$i]['estadoResponsavel']));
			$detalheApuracao[$i]['complementoResponsavel'] = utf8_encode($detalheApuracao[$i]['complementoResponsavel']);
			$detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfVitima']));
			$detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularVitima']));
			$detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($detalheApuracao[$i]['cpfResponsavel']));
			$detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($detalheApuracao[$i]['celularResponsavel']));
			$detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepVitima']));
			$detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($detalheApuracao[$i]['cepResponsavel']));
			$detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($detalheApuracao[$i]['dataRegistro']));
		}
		
		return $detalheApuracao;
	}

	//LISTA CONFIRMACAO
	public static function getListaConfirmacao()
	{	
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$listaConfirmacao = $mapuracao->listConfirmacaoCompleta();

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaConfirmacao);

		//Esse loop serve para tirar a duplicação de informação que vem do banco
		//Pois se tiver duas ou mais vitimas vinculada a apuracao entao ele se duplica
		//E para exibir essa lista nao pode repetir por isso excluir os dados repetidos
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaConfirmacao[$i])) {
				//se existe guarda em id
				$id = $listaConfirmacao[$i]['idCriarApuracao'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaConfirmacao[$a]['idCriarApuracao']) {
					unset($listaConfirmacao[$a]);
				}
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaConfirmacao[$i])) {
				$listaConfirmacao[$i]['descricao'] = utf8_encode($listaConfirmacao[$i]['descricao']);
				$listaConfirmacao[$i]['tipoApuracao'] = utf8_encode($listaConfirmacao[$i]['tipoApuracao']);
				$listaConfirmacao[$i]['qualFamilia'] = utf8_encode($listaConfirmacao[$i]['qualFamilia']);
				$listaConfirmacao[$i]['nomeVitima'] = utf8_encode($listaConfirmacao[$i]['nomeVitima']);
				$listaConfirmacao[$i]['nomeResponsavel'] = utf8_encode($listaConfirmacao[$i]['nomeResponsavel']);
				$listaConfirmacao[$i]['ruaVitima'] = utf8_encode($listaConfirmacao[$i]['ruaVitima']);
				$listaConfirmacao[$i]['bairroVitima'] = utf8_encode($listaConfirmacao[$i]['bairroVitima']);
				$listaConfirmacao[$i]['cidadeVitima'] = utf8_encode($listaConfirmacao[$i]['cidadeVitima']);
				$listaConfirmacao[$i]['estadoVitima'] = strtoupper(utf8_encode($listaConfirmacao[$i]['estadoVitima']));
				$listaConfirmacao[$i]['complementoVitima'] = utf8_encode($listaConfirmacao[$i]['complementoVitima']);
				$listaConfirmacao[$i]['ruaResponsavel'] = utf8_encode($listaConfirmacao[$i]['ruaResponsavel']);
				$listaConfirmacao[$i]['bairroResponsavel'] = utf8_encode($listaConfirmacao[$i]['bairroResponsavel']);
				$listaConfirmacao[$i]['cidadeResponsavel'] = utf8_encode($listaConfirmacao[$i]['cidadeResponsavel']);
				$listaConfirmacao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($listaConfirmacao[$i]['estadoResponsavel']));
				$listaConfirmacao[$i]['complementoResponsavel'] = utf8_encode($listaConfirmacao[$i]['complementoResponsavel']);
				$listaConfirmacao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($listaConfirmacao[$i]['cpfVitima']));
				$listaConfirmacao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($listaConfirmacao[$i]['celularVitima']));
				$listaConfirmacao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($listaConfirmacao[$i]['cpfResponsavel']));
				$listaConfirmacao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($listaConfirmacao[$i]['celularResponsavel']));
				$listaConfirmacao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($listaConfirmacao[$i]['cepVitima']));
				$listaConfirmacao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($listaConfirmacao[$i]['cepResponsavel']));
				$listaConfirmacao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($listaConfirmacao[$i]['dataRegistro']));
				$listaConfirmacao[$i]['registroConfirmacao'] = $validacao->replaceDataView(utf8_encode($listaConfirmacao[$i]['registroConfirmacao']));
			}
		}

		return $listaConfirmacao;
	}

}

?>