<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;
use \App\Model\MNotificacao;

class CListaApuracao {

	public static function getGerarOcorrencia($idApuracao)
	{
		$mapuracao = new MApuracao;
		$mnotificacao = new MNotificacao;

		$mapuracao->confirmacaoApuracao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario'], 1, 0);

		$mapuracao->updateStatus(2, $idApuracao);

		$mapuracao->gerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);

		//Notificacao
		$mnotificacao->cadastrar("Apuração para Votar", "/confirmar-apuracao-detalhe/".$idApuracao);
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
			$detalheApuracao[$i]['descricao'] = $detalheApuracao[$i]['descricao'];
			$detalheApuracao[$i]['tipoApuracao'] = $detalheApuracao[$i]['tipoApuracao'];
			$detalheApuracao[$i]['qualFamilia'] = $detalheApuracao[$i]['qualFamilia'];
			$detalheApuracao[$i]['nomeVitima'] = $detalheApuracao[$i]['nomeVitima'];
			$detalheApuracao[$i]['nomeResponsavel'] = $detalheApuracao[$i]['nomeResponsavel'];
			$detalheApuracao[$i]['ruaVitima'] = $detalheApuracao[$i]['ruaVitima'];
			$detalheApuracao[$i]['bairroVitima'] = $detalheApuracao[$i]['bairroVitima'];
			$detalheApuracao[$i]['cidadeVitima'] = $detalheApuracao[$i]['cidadeVitima'];
			$detalheApuracao[$i]['estadoVitima'] = strtoupper($detalheApuracao[$i]['estadoVitima']);
			$detalheApuracao[$i]['complementoVitima'] = $detalheApuracao[$i]['complementoVitima'];
			$detalheApuracao[$i]['ruaResponsavel'] = $detalheApuracao[$i]['ruaResponsavel'];
			$detalheApuracao[$i]['bairroResponsavel'] = $detalheApuracao[$i]['bairroResponsavel'];
			$detalheApuracao[$i]['cidadeResponsavel'] = $detalheApuracao[$i]['cidadeResponsavel'];
			$detalheApuracao[$i]['estadoResponsavel'] = strtoupper($detalheApuracao[$i]['estadoResponsavel']);
			$detalheApuracao[$i]['complementoResponsavel'] = $detalheApuracao[$i]['complementoResponsavel'];
			$detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfVitima']);
			$detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularVitima']);
			$detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfResponsavel']);
			$detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularResponsavel']);
			$detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView($detalheApuracao[$i]['cepVitima']);
			$detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView($detalheApuracao[$i]['cepResponsavel']);
			$detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView($detalheApuracao[$i]['dataRegistro']);
			$detalheApuracao[$i]['dataCriacao'] = $validacao->replaceDataView($detalheApuracao[$i]['dataCriacao']);
			$detalheApuracao[$i]['quemCriouApuracao'] = $detalheApuracao[$i]['quemCriouApuracao'];
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
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaApuracao[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaApuracao[$i])) {
				$listaApuracao[$i]['descricao'] = $listaApuracao[$i]['descricao'];
				$listaApuracao[$i]['tipoApuracao'] = $listaApuracao[$i]['tipoApuracao'];
				$listaApuracao[$i]['qualFamilia'] = $listaApuracao[$i]['qualFamilia'];
				$listaApuracao[$i]['nomeVitima'] = $listaApuracao[$i]['nomeVitima'];
				$listaApuracao[$i]['nomeResponsavel'] = $listaApuracao[$i]['nomeResponsavel'];
				$listaApuracao[$i]['ruaVitima'] = $listaApuracao[$i]['ruaVitima'];
				$listaApuracao[$i]['bairroVitima'] = $listaApuracao[$i]['bairroVitima'];
				$listaApuracao[$i]['cidadeVitima'] = $listaApuracao[$i]['cidadeVitima'];
				$listaApuracao[$i]['estadoVitima'] = strtoupper($listaApuracao[$i]['estadoVitima']);
				$listaApuracao[$i]['complementoVitima'] = $listaApuracao[$i]['complementoVitima'];
				$listaApuracao[$i]['ruaResponsavel'] = $listaApuracao[$i]['ruaResponsavel'];
				$listaApuracao[$i]['bairroResponsavel'] = $listaApuracao[$i]['bairroResponsavel'];
				$listaApuracao[$i]['cidadeResponsavel'] = $listaApuracao[$i]['cidadeResponsavel'];
				$listaApuracao[$i]['estadoResponsavel'] = strtoupper($listaApuracao[$i]['estadoResponsavel']);
				$listaApuracao[$i]['complementoResponsavel'] = $listaApuracao[$i]['complementoResponsavel'];
				$listaApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView($listaApuracao[$i]['cpfVitima']);
				$listaApuracao[$i]['celularVitima'] = $validacao->replaceCelularView($listaApuracao[$i]['celularVitima']);
				$listaApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($listaApuracao[$i]['cpfResponsavel']);
				$listaApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView($listaApuracao[$i]['celularResponsavel']);
				$listaApuracao[$i]['cepVitima'] = $validacao->replaceCepView($listaApuracao[$i]['cepVitima']);
				$listaApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView($listaApuracao[$i]['cepResponsavel']);
				$listaApuracao[$i]['dataRegistro'] = $validacao->replaceDataView($listaApuracao[$i]['dataRegistro']);
				$listaApuracao[$i]['dataCriacao'] = $validacao->replaceDataView($listaApuracao[$i]['dataCriacao']);
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
			$detalheApuracao[$i]['descricao'] = $detalheApuracao[$i]['descricao'];
			$detalheApuracao[$i]['tipoApuracao'] = $detalheApuracao[$i]['tipoApuracao'];
			$detalheApuracao[$i]['qualFamilia'] = $detalheApuracao[$i]['qualFamilia'];
			$detalheApuracao[$i]['nomeVitima'] = $detalheApuracao[$i]['nomeVitima'];
			$detalheApuracao[$i]['nomeResponsavel'] = $detalheApuracao[$i]['nomeResponsavel'];
			$detalheApuracao[$i]['ruaVitima'] = $detalheApuracao[$i]['ruaVitima'];
			$detalheApuracao[$i]['bairroVitima'] = $detalheApuracao[$i]['bairroVitima'];
			$detalheApuracao[$i]['cidadeVitima'] = $detalheApuracao[$i]['cidadeVitima'];
			$detalheApuracao[$i]['estadoVitima'] = strtoupper($detalheApuracao[$i]['estadoVitima']);
			$detalheApuracao[$i]['complementoVitima'] = $detalheApuracao[$i]['complementoVitima'];
			$detalheApuracao[$i]['ruaResponsavel'] = $detalheApuracao[$i]['ruaResponsavel'];
			$detalheApuracao[$i]['bairroResponsavel'] = $detalheApuracao[$i]['bairroResponsavel'];
			$detalheApuracao[$i]['cidadeResponsavel'] = $detalheApuracao[$i]['cidadeResponsavel'];
			$detalheApuracao[$i]['estadoResponsavel'] = strtoupper($detalheApuracao[$i]['estadoResponsavel']);
			$detalheApuracao[$i]['complementoResponsavel'] = $detalheApuracao[$i]['complementoResponsavel'];
			$detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfVitima']);
			$detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularVitima']);
			$detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfResponsavel']);
			$detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularResponsavel']);
			$detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView($detalheApuracao[$i]['cepVitima']);
			$detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView($detalheApuracao[$i]['cepResponsavel']);
			$detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView($detalheApuracao[$i]['dataRegistro']);
			$detalheApuracao[$i]['dataCriacao'] = $validacao->replaceDataView($detalheApuracao[$i]['dataCriacao']);
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
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaConfirmacao[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaConfirmacao[$i])) {
				$listaConfirmacao[$i]['descricao'] = $listaConfirmacao[$i]['descricao'];
				$listaConfirmacao[$i]['tipoApuracao'] = $listaConfirmacao[$i]['tipoApuracao'];
				$listaConfirmacao[$i]['qualFamilia'] = $listaConfirmacao[$i]['qualFamilia'];
				$listaConfirmacao[$i]['nomeVitima'] = $listaConfirmacao[$i]['nomeVitima'];
				$listaConfirmacao[$i]['nomeResponsavel'] = $listaConfirmacao[$i]['nomeResponsavel'];
				$listaConfirmacao[$i]['ruaVitima'] = $listaConfirmacao[$i]['ruaVitima'];
				$listaConfirmacao[$i]['bairroVitima'] = $listaConfirmacao[$i]['bairroVitima'];
				$listaConfirmacao[$i]['cidadeVitima'] = $listaConfirmacao[$i]['cidadeVitima'];
				$listaConfirmacao[$i]['estadoVitima'] = strtoupper($listaConfirmacao[$i]['estadoVitima']);
				$listaConfirmacao[$i]['complementoVitima'] = $listaConfirmacao[$i]['complementoVitima'];
				$listaConfirmacao[$i]['ruaResponsavel'] = $listaConfirmacao[$i]['ruaResponsavel'];
				$listaConfirmacao[$i]['bairroResponsavel'] = $listaConfirmacao[$i]['bairroResponsavel'];
				$listaConfirmacao[$i]['cidadeResponsavel'] = $listaConfirmacao[$i]['cidadeResponsavel'];
				$listaConfirmacao[$i]['estadoResponsavel'] = strtoupper($listaConfirmacao[$i]['estadoResponsavel']);
				$listaConfirmacao[$i]['complementoResponsavel'] = $listaConfirmacao[$i]['complementoResponsavel'];
				$listaConfirmacao[$i]['cpfVitima'] = $validacao->replaceCpfView($listaConfirmacao[$i]['cpfVitima']);
				$listaConfirmacao[$i]['celularVitima'] = $validacao->replaceCelularView($listaConfirmacao[$i]['celularVitima']);
				$listaConfirmacao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($listaConfirmacao[$i]['cpfResponsavel']);
				$listaConfirmacao[$i]['celularResponsavel'] = $validacao->replaceCelularView($listaConfirmacao[$i]['celularResponsavel']);
				$listaConfirmacao[$i]['cepVitima'] = $validacao->replaceCepView($listaConfirmacao[$i]['cepVitima']);
				$listaConfirmacao[$i]['cepResponsavel'] = $validacao->replaceCepView($listaConfirmacao[$i]['cepResponsavel']);
				$listaConfirmacao[$i]['dataRegistro'] = $validacao->replaceDataView($listaConfirmacao[$i]['dataRegistro']);
				$listaConfirmacao[$i]['registroConfirmacao'] = $validacao->replaceDataView($listaConfirmacao[$i]['registroConfirmacao']);
				$listaConfirmacao[$i]['dataCriacao'] = $validacao->replaceDataView($listaConfirmacao[$i]['dataCriacao']);
			}
		}

		return $listaConfirmacao;
	}

	public static function getListaApuracaoExcluida()
	{	
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$listaApuracao = $mapuracao->listApuracaoCompletaExcluida();

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
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaApuracao[$value]);
			}
		}

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica se a posicao existe no array porque excluimos algumas repetidas anteriormente
			if (isset($listaApuracao[$i])) {
				$listaApuracao[$i]['descricao'] = $listaApuracao[$i]['descricao'];
				$listaApuracao[$i]['tipoApuracao'] = $listaApuracao[$i]['tipoApuracao'];
				$listaApuracao[$i]['qualFamilia'] = $listaApuracao[$i]['qualFamilia'];
				$listaApuracao[$i]['nomeVitima'] = $listaApuracao[$i]['nomeVitima'];
				$listaApuracao[$i]['nomeResponsavel'] = $listaApuracao[$i]['nomeResponsavel'];
				$listaApuracao[$i]['ruaVitima'] = $listaApuracao[$i]['ruaVitima'];
				$listaApuracao[$i]['bairroVitima'] = $listaApuracao[$i]['bairroVitima'];
				$listaApuracao[$i]['cidadeVitima'] = $listaApuracao[$i]['cidadeVitima'];
				$listaApuracao[$i]['estadoVitima'] = strtoupper($listaApuracao[$i]['estadoVitima']);
				$listaApuracao[$i]['complementoVitima'] = $listaApuracao[$i]['complementoVitima'];
				$listaApuracao[$i]['ruaResponsavel'] = $listaApuracao[$i]['ruaResponsavel'];
				$listaApuracao[$i]['bairroResponsavel'] = $listaApuracao[$i]['bairroResponsavel'];
				$listaApuracao[$i]['cidadeResponsavel'] = $listaApuracao[$i]['cidadeResponsavel'];
				$listaApuracao[$i]['estadoResponsavel'] = strtoupper($listaApuracao[$i]['estadoResponsavel']);
				$listaApuracao[$i]['complementoResponsavel'] = $listaApuracao[$i]['complementoResponsavel'];
				$listaApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView($listaApuracao[$i]['cpfVitima']);
				$listaApuracao[$i]['celularVitima'] = $validacao->replaceCelularView($listaApuracao[$i]['celularVitima']);
				$listaApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($listaApuracao[$i]['cpfResponsavel']);
				$listaApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView($listaApuracao[$i]['celularResponsavel']);
				$listaApuracao[$i]['cepVitima'] = $validacao->replaceCepView($listaApuracao[$i]['cepVitima']);
				$listaApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView($listaApuracao[$i]['cepResponsavel']);
				$listaApuracao[$i]['dataRegistro'] = $validacao->replaceDataView($listaApuracao[$i]['dataRegistro']);
				$listaApuracao[$i]['dataCriacao'] = $validacao->replaceDataView($listaApuracao[$i]['dataCriacao']);
			}
		}

		return $listaApuracao;
	}

	public static function getApuracaoDetalheExcluida($idApuracao)
	{
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$detalheApuracao = $mapuracao->listApuracaoExcluida($idApuracao);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheApuracao);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$detalheApuracao[$i]['descricao'] = $detalheApuracao[$i]['descricao'];
			$detalheApuracao[$i]['setor'] = $detalheApuracao[$i]['setor'];
			$detalheApuracao[$i]['tipoApuracao'] = $detalheApuracao[$i]['tipoApuracao'];
			$detalheApuracao[$i]['qualFamilia'] = $detalheApuracao[$i]['qualFamilia'];
			$detalheApuracao[$i]['nomeVitima'] = $detalheApuracao[$i]['nomeVitima'];
			$detalheApuracao[$i]['nomeResponsavel'] = $detalheApuracao[$i]['nomeResponsavel'];
			$detalheApuracao[$i]['ruaVitima'] = $detalheApuracao[$i]['ruaVitima'];
			$detalheApuracao[$i]['bairroVitima'] = $detalheApuracao[$i]['bairroVitima'];
			$detalheApuracao[$i]['cidadeVitima'] = $detalheApuracao[$i]['cidadeVitima'];
			$detalheApuracao[$i]['estadoVitima'] = strtoupper($detalheApuracao[$i]['estadoVitima']);
			$detalheApuracao[$i]['complementoVitima'] = $detalheApuracao[$i]['complementoVitima'];
			$detalheApuracao[$i]['ruaResponsavel'] = $detalheApuracao[$i]['ruaResponsavel'];
			$detalheApuracao[$i]['bairroResponsavel'] = $detalheApuracao[$i]['bairroResponsavel'];
			$detalheApuracao[$i]['cidadeResponsavel'] = $detalheApuracao[$i]['cidadeResponsavel'];
			$detalheApuracao[$i]['estadoResponsavel'] = strtoupper($detalheApuracao[$i]['estadoResponsavel']);
			$detalheApuracao[$i]['complementoResponsavel'] = $detalheApuracao[$i]['complementoResponsavel'];
			$detalheApuracao[$i]['cpfVitima'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfVitima']);
			$detalheApuracao[$i]['celularVitima'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularVitima']);
			$detalheApuracao[$i]['cpfResponsavel'] = $validacao->replaceCpfView($detalheApuracao[$i]['cpfResponsavel']);
			$detalheApuracao[$i]['celularResponsavel'] = $validacao->replaceCelularView($detalheApuracao[$i]['celularResponsavel']);
			$detalheApuracao[$i]['cepVitima'] = $validacao->replaceCepView($detalheApuracao[$i]['cepVitima']);
			$detalheApuracao[$i]['cepResponsavel'] = $validacao->replaceCepView($detalheApuracao[$i]['cepResponsavel']);
			$detalheApuracao[$i]['dataRegistro'] = $validacao->replaceDataView($detalheApuracao[$i]['dataRegistro']);
			$detalheApuracao[$i]['dataCriacao'] = $validacao->replaceDataView($detalheApuracao[$i]['dataCriacao']);
			$detalheApuracao[$i]['quemCriouApuracao'] = $detalheApuracao[$i]['quemCriouApuracao'];
		}
		
		return $detalheApuracao;
	}

	public static function postReabrirApuracao($idApuracaoExcluida, $idApuracao, $post)
	{
		//Instancia
		$mapuracao = new MApuracao;

		//Analisar se tem dados na tabela ConfirmacaoApuracao para excluir
		$listaConfirmacao = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);

		//Zerar os votos da tabela ConfirmacaoApuracao
		if (isset($listaConfirmacao) && $listaConfirmacao != null && $listaConfirmacao != "") {
			$mapuracao->deletarConfirmacaoApuracao($idApuracao);
		}

		//Analisar se tem dados na tabela GerenciarConfirmacao para excluir
		$listGerenciarConfirmacao = $mapuracao->recuperarGerenciarConfirmacaoTodosUsuarios($idApuracao);

		//Excluir os votos da tabela GerenciarConfirmacao
		if (isset($listGerenciarConfirmacao) && $listGerenciarConfirmacao != null && $listGerenciarConfirmacao != "") {
			$mapuracao->deletarGerenciarConfirmacaoPorApuracao($idApuracao);
		}

		//Muda o status da tabela apuração excluida para nao mostrar mais
		//na lista de apuração excluida, mais fica cadastrado para registro
		$mapuracao->editarStatusApuracaoExcluida($idApuracaoExcluida);

		//Muda o status da apuração para voltar aparecer na lista de
		//Apuração abertas
		$mapuracao->updateStatus(1, $idApuracao);

		//Colocar o motivo na tabela reabrirApuracao
		$mapuracao->cadastrarReabrirApuracao($idApuracao, $_SESSION['User']['idUsuario'], $post);
	}

}

?>