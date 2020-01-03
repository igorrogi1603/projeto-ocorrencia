<?php

namespace App\Controller;

use \App\Classe\Agressor;
use \App\Classe\Instituicao;
use \App\Classe\Validacao;
use \App\Model\MAgressor;
use \App\Model\MInstituicao;
use \App\Model\MArquivo;
use \App\Model\MPessoa;
use \App\Controller\COcorrenciaAgressor;

class COcorrenciaAgressorEnviarArquivo extends COcorrenciaAgressor {

	public static function getEnviarArquivoLista($idOcorrencia)
	{	
		$marquivo = new MArquivo;
		$mpessoa = new MPessoa;
		$minstituicao = new MInstituicao;

		$listaAgressorArrumar = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrar($idOcorrencia);

		//Arrumar a ordem dos indices do array 0-1-2...
		foreach ($listaAgressorArrumar as $value) {
			$listaAgressor[] = $value;
		}

		//Resgatando os arquivos relacionado essas pessoas da vitima especifica
		for ($i = 0; $i < count($listaAgressor); $i++) {
			//Recuperando os dados da tabela arquivosPessoa
			if ($listaAgressor[$i]['isInstituicao'] == '0') {
				$arrayPessoa = $marquivo->listaArquivosPessoa($listaAgressor[$i]['id']);
				//Juntando os array
				$arrayCompleto[] = $arrayPessoa;
			}
			//Recuperando os dados da tabela arquivosInstituicao
			if ($listaAgressor[$i]['isInstituicao'] == '1') {
				$arrayInstituicao = $marquivo->listaArquivosInstituicao($listaAgressor[$i]['id']);
				//Juntando os array
				$arrayCompleto[] = $arrayInstituicao;
			}
		}

		//Separando os arrays para uma unica sequencia
		for ($i = 0; $i < count($arrayCompleto); $i++) {
			foreach ($arrayCompleto[$i] as $value) {
				if ($value['status'] == 0) {
					$listaArquivos[] = $value;
				}
			}
		}

		//Para saber se e instituicao ou pessoa
		foreach ($listaArquivos as $value) {
			if (isset($value['idPessoa'])) {
				$value['isInstituicao'] = '0';

				$novaListaArquivos[] = $value;
			}

			if (isset($value['idInstituicao'])) {
				$value['isInstituicao'] = '1';

				$novaListaArquivos[] = $value;
			}
		}

		//Caso nao exista a variavel listaArquivos
		if (isset($novaListaArquivos) && $novaListaArquivos != null && $novaListaArquivos != "") {
			return $novaListaArquivos;
		} else {
			return false;
		}
	}

	public static function postEnviarArquivoCadastrar($idOcorrencia, $post, $documento)
	{
		//Instancia
		$marquivo = new MArquivo;
		
		// verifica se foi enviado um arquivo
		if ( isset( $documento['name'] ) && $documento['error'] == 0 ) {
		    $arquivo_tmp = $documento['tmp_name'];
		    $nome = $documento['name'];

		    // Pega a extensão
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    // Converte a extensão para minúsculo
		    $extensao = strtolower ( $extensao );

		    $selecionePessoa = substr($post['selecionePessoa'], 2, 10);
		    $isInstituicao = substr($post['selecionePessoa'], 0, 1);

		    // Somente PDF, .pdf;
		    if ( strstr ( '.pdf', $extensao ) ) {
		        //Caso for pessoa fisica
		        if ($isInstituicao == "0") {
		        	//recuperando o ultimo id da tabela arquivosPessoa
		    		$ultimoIdArquivosPessoa = $marquivo->ultimoRegistroArquivosPessoa();

		        	//nome da pasta da pessoa
		    		$pastaPessoa = "pessoa" . $selecionePessoa;

		        	$novoNome = ((int)$ultimoIdArquivosPessoa[0]['MAX(idArquivosPessoa)'] + 1) . $post['selecioneDocumento'] . $selecionePessoa . '.' . $extensao;

		        	$novoDiretorio = '.'.DIRECTORY_SEPARATOR.'documentoPessoa'.DIRECTORY_SEPARATOR.$pastaPessoa;

			        if (!is_dir($novoDiretorio)) {
			        	//criar pasta identidades
			        	mkdir($novoDiretorio);
			        }

			        //Concatena a pasta com o nome
		        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
								"documentoPessoa" . DIRECTORY_SEPARATOR . 
								$pastaPessoa . DIRECTORY_SEPARATOR . $novoNome;
		        }

		        //Caso for instituicao
		        if ($isInstituicao == "1") {
		        	//recuperando o ultimo id da tabela arquivosPessoa
		    		$ultimoIdArquivosInstituicao = $marquivo->ultimoRegistroArquivosInstituicao();

		        	//nome da pasta da instituicao
		    		$pastaInstituicao = "instituicao" . $selecionePessoa;

		    		$novoNome = ((int)$ultimoIdArquivosInstituicao[0]['MAX(idArquivosInstituicao)'] + 1) . $post['selecioneDocumento'] . $selecionePessoa . '.' . $extensao;

		        	$novoDiretorio = '.'.DIRECTORY_SEPARATOR.'documentoInstituicao'.DIRECTORY_SEPARATOR.$pastaInstituicao;

			        if (!is_dir($novoDiretorio)) {
			        	//criar pasta identidades
			        	mkdir($novoDiretorio);
			        }

			        //Concatena a pasta com o nome
		        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
								"documentoInstituicao" . DIRECTORY_SEPARATOR . 
								$pastaInstituicao . DIRECTORY_SEPARATOR . $novoNome;
		        }

		        // tenta mover o arquivo para o destino
		        if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$destino_final = str_replace($_SERVER['DOCUMENT_ROOT'], '', $destino);

		        	//Pessoa fisica
		        	if ($isInstituicao == "0") {
		        		//Cadastrando na tabela tb_arquivosPessoa
						$marquivo->cadastrarArquivosPessoa($selecionePessoa, $post['selecioneDocumento'], $destino_final);
		        	}

		        	//Instituicao
		        	if ($isInstituicao == "1") {
		        		//Cadastrando na tabela tb_arquivosInstituicao
						$marquivo->cadastrarArquivosInstituicao($selecionePessoa, $post['selecioneDocumento'], $destino_final);
		        	}

					//Cadastrando na tabela tb_arquivos
					$marquivo->cadastrarArquivo($post['selecioneDocumento'], $destino_final);

					//Resgata o arquivo criado
					$idArquivoNovo = $marquivo->ultimoRegistroArquivo();

					//registra na tabela tb_arquivosProcessoOcorrencia
					$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivoNovo[0]["MAX(idArquivo)"]);

		        } else {
		            Validacao::setMsgError("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.");
			        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
			        exit;
		        }
		    } else {
		        Validacao::setMsgError("Você pode enviar apenas arquivos PDF");
		        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
		        exit;
		    }
		} else {
		    Validacao::setMsgError("Você não enviou nenhum arquivo!");
	        header('Location: /ocorrencia-agressor-enviar-arquivo-cadastrar/'.$idOcorrencia);
	        exit;
		}
	}

	public static function getEnviarArquivoCadastrar($idOcorrencia)
	{
		$listaAgressor = COcorrenciaAgressor::listaAgressor($idOcorrencia);
		$listaInstituicao = COcorrenciaAgressor::listaInstituicao($idOcorrencia);

		if (isset($listaAgressor) && $listaAgressor != null & $listaAgressor != "") {
			//Juntando os dois array em um so array chamado dados
			foreach ($listaAgressor as $value) {
				$dados[] = $value;
			}
		}

		if (isset($listaInstituicao) && $listaInstituicao != null & $listaInstituicao != "") {
			foreach ($listaInstituicao as $value) {
				$dados[] = $value;
			}
		}

		if (isset($dados) && $dados != null && $dados != "") {

			//Tamanho do array dados
			$tamanhoArrayDados = count($dados);

			//pegando apenas os nomes e os id das vitimas e responsaveis
			foreach ($dados as $key => $value) {
				$arrayNome[]['nome'] = $value['nome'];

				if ($value['idPessoa'] != null) {
					$arrayId[]['id'] = $value['idPessoa'];
					$arrayIsInstituicao[]['isInstituicao'] = "0";
				}
				
				if ($value['idInstituicao'] != null) {
					$arrayId[]['id'] = $value['idInstituicao'];
					$arrayIsInstituicao[]['isInstituicao'] = "1";
				}
			}

			//Junta o nome e o id de cada pessoa em um unico array
			for ($a = 0; $a < $tamanhoArrayDados; $a++) {
				$arrayPessoas[$a]['nome'] = $arrayNome[$a]['nome'];
				$arrayPessoas[$a]['id'] = $arrayId[$a]['id'];
				$arrayPessoas[$a]['isInstituicao'] = $arrayIsInstituicao[$a]['isInstituicao'];
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
		} else {
			return false;
		}
	}

	public static function getEnviarArquivoCadastrarAtualizar($idOcorrencia, $idPessoa)
	{
		$dados = COcorrenciaAgressorEnviarArquivo::getEnviarArquivoCadastrar($idOcorrencia);

		foreach ($dados as $key => $value) {
			if ($value['id'] == $idPessoa) {
				$dadoFinal = $dados[$key];
			}
		}

		return $dadoFinal;
	}

	public static function postEnviarArquivoCadastrarAtualizar($idOcorrencia, $post, $documento, $idArquivo, $isInstituicao)
	{	
		$marquivo = new MArquivo;

		//Instituicao
		if (isset($isInstituicao) && $isInstituicao == 1) {
			$marquivo->atualizarStatusArquivosInstituicao($idArquivo, 1);
		}

		//Pessoa
		if (isset($isInstituicao) && $isInstituicao == 0) {
			$marquivo->atualizarStatusArquivosPessoa($idArquivo, 1);
		}

		COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrar($idOcorrencia, $post, $documento);
	}

}

?>