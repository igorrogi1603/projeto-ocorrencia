<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Classe\Usuario;
use \App\Model\MApuracao;

class CListaConfirmacao {

	public static function getConfirmacaoNegativo($idApuracao, $idConfirmacao)
	{
		$mapuracao = new MApuracao;

		//Recupero na tabela para ver se tem alguma informacao do usuario logado
		//Caso nessa tabela tenha uma informacao desse usuario quer dizer que ele ja votou
		$voto = count($mapuracao->recuperarGerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']));

		//Recupero as informacao da confirmacao para alterar os votos
		$confirmarApuracao = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);

		//Caso os votos negativos forem menores que dois entra aqui
		if ($confirmarApuracao[0]['isNegativo'] < 2) {
			if ($voto === 0){
				//Recuperando o isNegativo atual do banco de dados
				$isNegativo = $mapuracao->recuperarConfirmacaoNegativo($idConfirmacao);

				//Atualizando o isNegativo para mais um a partir do atual
				$mapuracao->updateConfirmacaoNegativo($idConfirmacao, $isNegativo[0]['isNegativo']);

				//Cadastrando na tabela o usuario que ja votou pois nao pode votar duas vezes
				$mapuracao->gerenciarConfirmacao($idApuracao, $_SESSION[Usuario::SESSION]['idUsuario']);

				$confirmarApuracaoPronta = $mapuracao->recuperarConfirmacaoApuracao($idApuracao);
			} else {
				Validacao::setMsgError("Você já votou nessa apuracão.");
		        header('Location: /confirmar-apuracao-detalhe/'.$idApuracao);
		        exit;
			}
		}

		//Caso os votos forem dois entra aqui
		if ($confirmarApuracaoPronta[0]['isNegativo'] == 2) {
			//Descartar Apuracao
			header('Location: /confirmacao-detalhe/descartar/'.$idApuracao.'/'.$idConfirmacao);
			exit;
		}
	}

	public static function confirmacaoDetalheCancelar($idConfirmacao)
	{
		$mapuracao = new MApuracao;

		$isNegativo = $mapuracao->recuperarConfirmacaoNegativo($idConfirmacao);

		$mapuracao->updateConfirmacaoNegativoCancelar($idConfirmacao, $isNegativo[0]['isNegativo']);

		$mapuracao->deletarGerenciarConfirmacao($_SESSION[Usuario::SESSION]['idUsuario']);
	}

	public static function getConfirmacaoDetalhe($idApuracao)
	{
		//instaciando
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		//Recupera todos os dados do banco
		$detalheConfirmacao = $mapuracao->listConfirmacao($idApuracao);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($detalheConfirmacao);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$detalheConfirmacao[$i]['descricao'] = utf8_encode($detalheConfirmacao[$i]['descricao']);
			$detalheConfirmacao[$i]['tipoApuracao'] = utf8_encode($detalheConfirmacao[$i]['tipoApuracao']);
			$detalheConfirmacao[$i]['qualFamilia'] = utf8_encode($detalheConfirmacao[$i]['qualFamilia']);
			$detalheConfirmacao[$i]['nomeVitima'] = utf8_encode($detalheConfirmacao[$i]['nomeVitima']);
			$detalheConfirmacao[$i]['nomeResponsavel'] = utf8_encode($detalheConfirmacao[$i]['nomeResponsavel']);
			$detalheConfirmacao[$i]['ruaVitima'] = utf8_encode($detalheConfirmacao[$i]['ruaVitima']);
			$detalheConfirmacao[$i]['bairroVitima'] = utf8_encode($detalheConfirmacao[$i]['bairroVitima']);
			$detalheConfirmacao[$i]['cidadeVitima'] = utf8_encode($detalheConfirmacao[$i]['cidadeVitima']);
			$detalheConfirmacao[$i]['estadoVitima'] = strtoupper(utf8_encode($detalheConfirmacao[$i]['estadoVitima']));
			$detalheConfirmacao[$i]['complementoVitima'] = utf8_encode($detalheConfirmacao[$i]['complementoVitima']);
			$detalheConfirmacao[$i]['ruaResponsavel'] = utf8_encode($detalheConfirmacao[$i]['ruaResponsavel']);
			$detalheConfirmacao[$i]['bairroResponsavel'] = utf8_encode($detalheConfirmacao[$i]['bairroResponsavel']);
			$detalheConfirmacao[$i]['cidadeResponsavel'] = utf8_encode($detalheConfirmacao[$i]['cidadeResponsavel']);
			$detalheConfirmacao[$i]['estadoResponsavel'] = strtoupper(utf8_encode($detalheConfirmacao[$i]['estadoResponsavel']));
			$detalheConfirmacao[$i]['complementoResponsavel'] = utf8_encode($detalheConfirmacao[$i]['complementoResponsavel']);
			$detalheConfirmacao[$i]['cpfVitima'] = $validacao->replaceCpfView(utf8_encode($detalheConfirmacao[$i]['cpfVitima']));
			$detalheConfirmacao[$i]['celularVitima'] = $validacao->replaceCelularView(utf8_encode($detalheConfirmacao[$i]['celularVitima']));
			$detalheConfirmacao[$i]['cpfResponsavel'] = $validacao->replaceCpfView(utf8_encode($detalheConfirmacao[$i]['cpfResponsavel']));
			$detalheConfirmacao[$i]['celularResponsavel'] = $validacao->replaceCelularView(utf8_encode($detalheConfirmacao[$i]['celularResponsavel']));
			$detalheConfirmacao[$i]['cepVitima'] = $validacao->replaceCepView(utf8_encode($detalheConfirmacao[$i]['cepVitima']));
			$detalheConfirmacao[$i]['cepResponsavel'] = $validacao->replaceCepView(utf8_encode($detalheConfirmacao[$i]['cepResponsavel']));
			$detalheConfirmacao[$i]['dataRegistro'] = $validacao->replaceDataView(utf8_encode($detalheConfirmacao[$i]['dataRegistro']));
		}
		
		return $detalheConfirmacao;
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