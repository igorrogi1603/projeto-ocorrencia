<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MPessoa;
use \App\Model\MArquivo;
use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MAcompanhamento;

class COcorrenciaVitima {

	public static function postOcorrenciaVitimaEditar($idVitima, $idOcorrencia, $idPessoa, $post)
	{
		$mpessoa = new MPessoa;
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$marquivo = new MArquivo;
		$validacao = new Validacao;
		$macompanhamento = new MAcompanhamento;

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

		//atualiza os dados
		$mpessoa->update($post, $idPessoa, 'vitima');
		$mcontato->update($post, $idContato, 'vitima');
		$mendereco->update($post, $idEndereco, 'vitima');

		//pega o endereco que acobou de atualizar
		$enderecoPosAtualizar = $mendereco->enderecoEspecifico($idEndereco);

		//recupera todos os dados dessa tabela 
		$listaAcompanhamento = $macompanhamento->listAll($idVitima);

		//verifica se existem enderecos cadastrados no id da vitima
		if (isset($listaAcompanhamento) && $listaAcompanhamento != null && $listaAcompanhamento != "") {
			//verifica se o endereco atual da vitima ja nao esta cadastrado para evitar de cadastrar igual
			foreach ($listaAcompanhamento as $value) {
				if ($value['cep'] == $enderecoPosAtualizar[0]['cep']) {
					//foi atualizado para o mesmo endereco atual da vitima
					//entao nao cadastrar
					$cadastrarAcompanhamento = false;
				} else {
					//nao é igual ao endereco atual
					//pode cadastrar o novo
					$cadastrarAcompanhamento = true;
					$idAcompanhamento = $value['idAcompanhamentoVitima'];
				}
			}

			//caso for true o endereco atual nao é igual o atualizado
			if ($cadastrarAcompanhamento == true) {
				//mudar o status do endereco antigo
				$macompanhamento->update($idAcompanhamento);

				//cadastra o novo endereco da vitima
				$macompanhamento->cadastrar($post, $idVitima);
			}
		} else {
			//se for vazio o array entao nao tem endereco no id da vitima
			//cadastra o novo endereco da vitima
			$macompanhamento->cadastrar($post, $idVitima);
		}

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfEditarVitima.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "vitima".$idVitima."Editada".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."Arquivos".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

		//Instancia o mpdf
		$mpdf = new Mpdf();

		//Permitir marca d'agua
		$mpdf->showWatermarkText = true;

		//Coloca o html criado dentro da variavel para gerar o pdf
		$mpdf->WriteHTML($pagina);

		//Colocar o PDF dentro da pasta da ocorrencia criada
		$mpdf->Output($destino."".$arquivo, 'F');

		//--------------------------------------------------------
		//Preencher a tabela de arquivos da ocorrencia
		//criando a url
		$novaUrl = str_replace('.', '', $destino);
		$url = $novaUrl."".$arquivo;

		//Cadastrando na tabela tb_arquivos
		$marquivo->cadastrarArquivo('Vitima Editada', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
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

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaVitimas[$value]);
			}
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

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaVitimas[$value]);
			}
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
			$vitimaOcorrencia[$i]['descricao'] = $vitimaOcorrencia[$i]['descricao'];
			$vitimaOcorrencia[$i]['tipoApuracao'] = $vitimaOcorrencia[$i]['tipoApuracao'];
			$vitimaOcorrencia[$i]['qualFamilia'] = $vitimaOcorrencia[$i]['qualFamilia'];
			$vitimaOcorrencia[$i]['nomeVitima'] = $vitimaOcorrencia[$i]['nomeVitima'];
			$vitimaOcorrencia[$i]['nomeResponsavel'] = $vitimaOcorrencia[$i]['nomeResponsavel'];
			$vitimaOcorrencia[$i]['ruaVitima'] = $vitimaOcorrencia[$i]['ruaVitima'];
			$vitimaOcorrencia[$i]['bairroVitima'] = $vitimaOcorrencia[$i]['bairroVitima'];
			$vitimaOcorrencia[$i]['cidadeVitima'] = $vitimaOcorrencia[$i]['cidadeVitima'];
			$vitimaOcorrencia[$i]['estadoVitima'] = strtoupper($vitimaOcorrencia[$i]['estadoVitima']);
			$vitimaOcorrencia[$i]['complementoVitima'] = $vitimaOcorrencia[$i]['complementoVitima'];
			$vitimaOcorrencia[$i]['ruaResponsavel'] = $vitimaOcorrencia[$i]['ruaResponsavel'];
			$vitimaOcorrencia[$i]['bairroResponsavel'] = $vitimaOcorrencia[$i]['bairroResponsavel'];
			$vitimaOcorrencia[$i]['cidadeResponsavel'] = $vitimaOcorrencia[$i]['cidadeResponsavel'];
			$vitimaOcorrencia[$i]['estadoResponsavel'] = strtoupper($vitimaOcorrencia[$i]['estadoResponsavel']);
			$vitimaOcorrencia[$i]['complementoResponsavel'] = $vitimaOcorrencia[$i]['complementoResponsavel'];
			$vitimaOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView($vitimaOcorrencia[$i]['cpfVitima']);
			$vitimaOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView($vitimaOcorrencia[$i]['celularVitima']);
			$vitimaOcorrencia[$i]['fixoVitima'] = $validacao->replaceTelefoneFixoView($vitimaOcorrencia[$i]['fixoVitima']);
			$vitimaOcorrencia[$i]['fixoResponsavel'] = $validacao->replaceTelefoneFixoView($vitimaOcorrencia[$i]['fixoResponsavel']);
			$vitimaOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView($vitimaOcorrencia[$i]['cpfResponsavel']);
			$vitimaOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView($vitimaOcorrencia[$i]['celularResponsavel']);
			$vitimaOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView($vitimaOcorrencia[$i]['cepVitima']);
			$vitimaOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView($vitimaOcorrencia[$i]['cepResponsavel']);
			$vitimaOcorrencia[$i]['rgVitimaDigito'] = $validacao->replaceDigitoRg($vitimaOcorrencia[$i]['rgVitima']);
			$vitimaOcorrencia[$i]['rgVitima'] = $validacao->replaceSemDigitoRg($vitimaOcorrencia[$i]['rgVitima']);
			$vitimaOcorrencia[$i]['rgResponsavelDigito'] = $validacao->replaceDigitoRg($vitimaOcorrencia[$i]['rgResponsavel']);
			$vitimaOcorrencia[$i]['rgResponsavel'] = $validacao->replaceSemDigitoRg($vitimaOcorrencia[$i]['rgResponsavel']);
			$vitimaOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView($vitimaOcorrencia[$i]['dataRegistroOcorrencia']);
			$vitimaOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView($vitimaOcorrencia[$i]['dataCriacaoOcorrencia']);

			if ($vitimaOcorrencia[$i]['dataNascVitima'] == null) {
				//mostra nada
			} else {
				$vitimaOcorrencia[$i]['dataNascVitima'] = $validacao->replaceDataView($vitimaOcorrencia[$i]['dataNascVitima']);
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
			$vitimasOcorrencia[$i]['descricao'] = $vitimasOcorrencia[$i]['descricao'];
			$vitimasOcorrencia[$i]['tipoApuracao'] = $vitimasOcorrencia[$i]['tipoApuracao'];
			$vitimasOcorrencia[$i]['qualFamilia'] = $vitimasOcorrencia[$i]['qualFamilia'];
			$vitimasOcorrencia[$i]['nomeVitima'] = $vitimasOcorrencia[$i]['nomeVitima'];
			$vitimasOcorrencia[$i]['nomeResponsavel'] = $vitimasOcorrencia[$i]['nomeResponsavel'];
			$vitimasOcorrencia[$i]['ruaVitima'] = $vitimasOcorrencia[$i]['ruaVitima'];
			$vitimasOcorrencia[$i]['bairroVitima'] = $vitimasOcorrencia[$i]['bairroVitima'];
			$vitimasOcorrencia[$i]['cidadeVitima'] = $vitimasOcorrencia[$i]['cidadeVitima'];
			$vitimasOcorrencia[$i]['estadoVitima'] = strtoupper($vitimasOcorrencia[$i]['estadoVitima']);
			$vitimasOcorrencia[$i]['complementoVitima'] = $vitimasOcorrencia[$i]['complementoVitima'];
			$vitimasOcorrencia[$i]['ruaResponsavel'] = $vitimasOcorrencia[$i]['ruaResponsavel'];
			$vitimasOcorrencia[$i]['bairroResponsavel'] = $vitimasOcorrencia[$i]['bairroResponsavel'];
			$vitimasOcorrencia[$i]['cidadeResponsavel'] = $vitimasOcorrencia[$i]['cidadeResponsavel'];
			$vitimasOcorrencia[$i]['estadoResponsavel'] = strtoupper($vitimasOcorrencia[$i]['estadoResponsavel']);
			$vitimasOcorrencia[$i]['complementoResponsavel'] = $vitimasOcorrencia[$i]['complementoResponsavel'];
			$vitimasOcorrencia[$i]['cpfVitima'] = $validacao->replaceCpfView($vitimasOcorrencia[$i]['cpfVitima']);
			$vitimasOcorrencia[$i]['celularVitima'] = $validacao->replaceCelularView($vitimasOcorrencia[$i]['celularVitima']);
			$vitimasOcorrencia[$i]['cpfResponsavel'] = $validacao->replaceCpfView($vitimasOcorrencia[$i]['cpfResponsavel']);
			$vitimasOcorrencia[$i]['celularResponsavel'] = $validacao->replaceCelularView($vitimasOcorrencia[$i]['celularResponsavel']);
			$vitimasOcorrencia[$i]['fixoVitima'] = $validacao->replaceTelefoneFixoView($vitimasOcorrencia[$i]['fixoVitima']);
			$vitimasOcorrencia[$i]['fixoResponsavel'] = $validacao->replaceTelefoneFixoView($vitimasOcorrencia[$i]['fixoResponsavel']);
			$vitimasOcorrencia[$i]['cepVitima'] = $validacao->replaceCepView($vitimasOcorrencia[$i]['cepVitima']);
			$vitimasOcorrencia[$i]['cepResponsavel'] = $validacao->replaceCepView($vitimasOcorrencia[$i]['cepResponsavel']);
			$vitimasOcorrencia[$i]['rgVitima'] = $validacao->replaceRgView($vitimasOcorrencia[$i]['rgVitima']);
			$vitimasOcorrencia[$i]['dataRegistroOcorrencia'] = $validacao->replaceDataView($vitimasOcorrencia[$i]['dataRegistroOcorrencia']);
			$vitimasOcorrencia[$i]['dataCriacaoOcorrencia'] = $validacao->replaceDataView($vitimasOcorrencia[$i]['dataCriacaoOcorrencia']);

			if ($vitimasOcorrencia[$i]['dataNascVitima'] == null) {
				//mostra nada
			} else {
				$vitimasOcorrencia[$i]['dataNascVitima'] = $validacao->replaceDataView($vitimasOcorrencia[$i]['dataNascVitima']);
			}
		}
		return $vitimasOcorrencia;
	}

}

?>