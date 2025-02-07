<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MArquivo;
use \App\Model\MPessoa;

class COcorrenciaEnviarArquivo {

	public static function getEnviarArquivoLista($idVitima, $idOcorrencia)
	{	
		$marquivo = new MArquivo;
		$mpessoa = new MPessoa;

		//Recuperando as pessoas relacionado a vitima especifica
		$listaPessoasArrumar = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrar($idVitima, $idOcorrencia);

		//Arrumar a ordem dos indices do array 0-1-2...
		foreach ($listaPessoasArrumar as $value) {
			$listaPessoas[] = $value;
		}

		//Resgatando os arquivos relacionado essas pessoas da vitima especifica
		for ($i = 0; $i < count($listaPessoas); $i++) {
			$array = $marquivo->listaArquivosPessoa($listaPessoas[$i]['id']);

			foreach ($array as $value) {
				if ($value['status'] == 0) {
					$listaArquivosPessoa[] = $value;
				}
			}
		}

		if (isset($listaArquivosPessoa) && $listaArquivosPessoa != null && $listaArquivosPessoa != "") {
			return $listaArquivosPessoa;
		} else {
			return false;
		}
	}

	public static function postEnviarArquivoCadastrar($documento, $post, $idVitima, $idOcorrencia)
	{
		//Instancia
		$marquivo = new MArquivo;

		// verifica se foi enviado um arquivo
		if ( isset( $documento['name'] ) && $documento['error'] == 0 ) {
		    $arquivo_tmp = $documento['tmp_name'];
		    $nome = $documento['name'];
		 	
		 	//recuperando o ultimo id da tabela arquivosPessoa
		    $ultimoIdArquivosPessoa = $marquivo->ultimoRegistroArquivosPessoa();

		    // Pega a extensão
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    // Converte a extensão para minúsculo
		    $extensao = strtolower ( $extensao );
		 
		    // Somente PDF, .pdf;
		    if ( strstr ( '.pdf', $extensao ) ) {
		        // Cria um nome único para esta imagem
		        // Evita que duplique as imagens no servidor.
		        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
		        $novoNome = ((int)$ultimoIdArquivosPessoa[0]['MAX(idArquivosPessoa)'] + 1) . $post['selecioneDocumento'] . $post['selecionePessoa'] . '.' . $extensao;
		 	
		        $pastaPessoa = "pessoa" . $post['selecionePessoa'];

		        $novoDiretorio = '.'.DIRECTORY_SEPARATOR.'documentoPessoa'.DIRECTORY_SEPARATOR.$pastaPessoa;

		        if (!is_dir($novoDiretorio)) {
		        	//criar pasta identidades
		        	mkdir($novoDiretorio);
		        }

		        // Concatena a pasta com o nome
	        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
	        				"Arquivos" . DIRECTORY_SEPARATOR .
							"documentoPessoa" . DIRECTORY_SEPARATOR . 
							$pastaPessoa . DIRECTORY_SEPARATOR . $novoNome;

		        // tenta mover o arquivo para o destino
		        if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$destino_final = str_replace($_SERVER['DOCUMENT_ROOT'], '', $destino);

					//Cadastrando na tabela tb_arquivosPessoa
					$marquivo->cadastrarArquivosPessoa($post['selecionePessoa'], $post['selecioneDocumento'], $destino_final);

					//Cadastrando na tabela tb_arquivos
					$marquivo->cadastrarArquivo($post['selecioneDocumento'], $destino_final);

					//Resgata o arquivo criado
					$idArquivoNovo = $marquivo->ultimoRegistroArquivo();

					//registra na tabela tb_arquivosProcessoOcorrencia
					$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivoNovo[0]["MAX(idArquivo)"]);
		        } else {
		            Validacao::setMsgError("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.");
			        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
			        exit;
		        }
		    } else {
		        Validacao::setMsgError("Você pode enviar apenas arquivos PDF");
		        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
		        exit;
		    }
		} else {
		    Validacao::setMsgError("Você não enviou nenhum arquivo!");
	        header('Location: /ocorrencia-vitima-enviar-arquivo-cadastrar/'.$idVitima.'/'.$idOcorrencia);
	        exit;
		}
	}

	public static function postEnviarArquivoCadastrarAtualizar($documento, $post, $idVitima, $idOcorrencia, $idArquivo)
	{	
		$marquivo = new MArquivo;

		$marquivo->atualizarStatusArquivosPessoa($idArquivo, 1);

		COcorrenciaEnviarArquivo::postEnviarArquivoCadastrar($documento, $post, $idVitima, $idOcorrencia);
	}

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
			for ($b = $i+1; $b < $tamanhoArray; $b++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $arrayPessoas[$b]['id']) {
					$arrayPosicaoExcluir[] = $b;
				}
			}
		}

		//caso nao tenha se repetido nenhum id no arrayPessoas
		//entao a variavel arrayPosicaoExcluir nao irá existir
		//caso ela nao exista gerará erro por isso verificar se ela existi
		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($arrayPessoas[$value]);
			}
		}

		return $arrayPessoas;
	}

	public static function getEnviarArquivoCadastrarAtualizar($idVitima, $idOcorrencia, $idPessoa)
	{
		$dados = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrar($idVitima, $idOcorrencia);

		foreach ($dados as $key => $value) {
			if ($value['id'] == $idPessoa) {
				$dadoFinal = $dados[$key];
			}
		}

		return $dadoFinal;
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
			$vitimaOcorrencia[$i]['outro'] = $vitimaOcorrencia[$i]['outro'];
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

}

?>