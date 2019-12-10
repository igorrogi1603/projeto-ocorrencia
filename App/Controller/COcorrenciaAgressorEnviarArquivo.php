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

		$pastaOcorrencia = 'ocorrencia' . $idOcorrencia;

		$novoDiretorioAgressor = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidadesAgressor';
		$novoDiretorioInstituicao = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidadesInstituicao';

        if (is_dir($novoDiretorioAgressor)) {

			//informando o local onde os arquivos estao
			$path = "ocorrencias".DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR."identidadesAgressor";
			$diretorio = dir($path);

			//contador
			$aux = 0;

			//pegando os arquivos da pasta
			while($arquivo = $diretorio -> read()){
				$documento[$aux]['url'] = DIRECTORY_SEPARATOR . $path. DIRECTORY_SEPARATOR .$arquivo;

				//Todos os arquivos sao pdf
				//so pode enviar arquivo pdf para o sistema
				$documento[$aux]['tipo'] = 'PDF';

				$documento[$aux]['arquivo'] = str_replace('.pdf', '', $arquivo);

				$idArquivo = $marquivo->pesquisarArquivo($documento[$aux]['url']);

				foreach ($idArquivo as $value) {
					$documento[$aux]['idArquivo'] = $value['idArquivo'];
					$documento[$aux]['status'] = $value['status'];

					//Verifica se tem cpf ou rg ... no nome do arquivo
					$posCpf = strpos($documento[$aux]['arquivo'], $documento[$aux]['idArquivo'].'cpf');
					$posRg = strpos($documento[$aux]['arquivo'], $documento[$aux]['idArquivo'].'rg');
					$posCnh = strpos($documento[$aux]['arquivo'], $documento[$aux]['idArquivo'].'cnh');
					$posCn = strpos($documento[$aux]['arquivo'], $documento[$aux]['idArquivo'].'cn');
					$posCnpj = strpos($documento[$aux]['arquivo'], $documento[$aux]['idArquivo'].'cnpj');

					//caso tenha, entao da o replace e deixa apenas o id da Pessoa
					if ($posCpf !== false) {
						$documento[$aux]['idPessoa'] = str_replace($documento[$aux]['idArquivo'].'cpf', '', $documento[$aux]['arquivo']);	
					}

					if ($posRg !== false) {
						$documento[$aux]['idPessoa'] = str_replace($documento[$aux]['idArquivo'].'rg', '', $documento[$aux]['arquivo']);	
					}
					
					if ($posCn !== false) {
						$documento[$aux]['idPessoa'] = str_replace($documento[$aux]['idArquivo'].'cn', '', $documento[$aux]['arquivo']);	
					}
					
					if ($posCnh !== false) {
						$documento[$aux]['idPessoa'] = str_replace($documento[$aux]['idArquivo'].'cnh', '', $documento[$aux]['arquivo']);	
					}

					if ($posCnpj !== false) {
						$documento[$aux]['idPessoa'] = str_replace($documento[$aux]['idArquivo'].'cnpj', '', $documento[$aux]['arquivo']);	
					}

					//Serve para comprar depois no view
					$documento[$aux]['idInstituicao'] = 'null';

					//Recuperando a pessoa para exibicao
					$listPessoa = $mpessoa->pessoaEspecifica($documento[$aux]['idPessoa']);

					//colocando o nome da pessoa na variavel
					foreach ($listPessoa as $value) {
						$documento[$aux]['nome'] = utf8_encode($value['nome']);
					}
				}
				$aux++;
			}

			$diretorio -> close();

			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($documento);

			//O que pesquisar no nome do arquivo
			$pesquisarDocumento = array("/Apuracao/");

			//deixando apenas o arquivo correto no array
			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Se os nome forem (.) ou (..) entao exclui
				if ($documento[$i]['arquivo'] == '.' || $documento[$i]['arquivo'] == '..') {
					$arrayPosicaoExcluir[] = $i;	
				}

				foreach ($pesquisarDocumento as $value) {
					if (preg_match($value, $documento[$i]['arquivo'])) {
						$arrayPosicaoExcluir[] = $i;
					} else {
						//nao achou
					}
				}
			}

			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($documento[$value]);
			}

			//recupera a lista de nomes de vitima e responsaveis dessa unica vitima
			$listaPessoas = COcorrenciaAgressor::listaAgressor($idOcorrencia);

			//verifica se o array dessa vitima com os seus reponsaveis
			//sao iguais o array dos documentos, caso seja igual exibi se nao exibi
			foreach ($documento as $doc) {
				foreach ($listaPessoas as $value) {
					if ($doc['nome'] == $value['nome']) {
						$documentoFinal[] = $documento;
					} else {
						return false;
					}
				}	
			}
			
		} else {
			return false;
		}

		if (is_dir($novoDiretorioInstituicao)) {

			//informando o local onde os arquivos estao
			$path2 = "ocorrencias".DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR."identidadesInstituicao";
			$diretorio2 = dir($path2);

			//contador
			$aux2 = 0;

			//pegando os arquivos da pasta
			while($arquivo = $diretorio2 -> read()){
				$documento2[$aux2]['url'] = DIRECTORY_SEPARATOR . $path2. DIRECTORY_SEPARATOR .$arquivo;

				//Todos os arquivos sao pdf
				//so pode enviar arquivo pdf para o sistema
				$documento2[$aux2]['tipo'] = 'PDF';

				$documento2[$aux2]['arquivo'] = str_replace('.pdf', '', $arquivo);

				$idArquivo = $marquivo->pesquisarArquivo($documento2[$aux2]['url']);

				foreach ($idArquivo as $value) {
					$documento2[$aux2]['idArquivo'] = $value['idArquivo'];
					$documento2[$aux2]['status'] = $value['status'];

					//Verifica se tem cpf ou rg ... no nome do arquivo
					$posCpf = strpos($documento2[$aux2]['arquivo'], $documento2[$aux2]['idArquivo'].'cpf');
					$posRg = strpos($documento2[$aux2]['arquivo'], $documento2[$aux2]['idArquivo'].'rg');
					$posCnh = strpos($documento2[$aux2]['arquivo'], $documento2[$aux2]['idArquivo'].'cnh');
					$posCn = strpos($documento2[$aux2]['arquivo'], $documento2[$aux2]['idArquivo'].'cn');
					$posCnpj = strpos($documento2[$aux2]['arquivo'], $documento2[$aux2]['idArquivo'].'cnpj');

					//caso tenha, entao da o replace e deixa apenas o id da Pessoa
					if ($posCpf !== false) {
						$documento2[$aux2]['idInstituicao'] = str_replace($documento2[$aux2]['idArquivo'].'cpf', '', $documento2[$aux2]['arquivo']);	
					}

					if ($posRg !== false) {
						$documento2[$aux2]['idInstituicao'] = str_replace($documento2[$aux2]['idArquivo'].'rg', '', $documento2[$aux2]['arquivo']);	
					}
					
					if ($posCnh !== false) {
						$documento2[$aux2]['idInstituicao'] = str_replace($documento2[$aux2]['idArquivo'].'cnh', '', $documento2[$aux2]['arquivo']);	
					}

					if ($posCn !== false) {
						$documento2[$aux2]['idInstituicao'] = str_replace($documento2[$aux2]['idArquivo'].'cn', '', $documento2[$aux2]['arquivo']);	
					}

					if ($posCnpj !== false) {
						$documento2[$aux2]['idInstituicao'] = str_replace($documento2[$aux2]['idArquivo'].'cnpj', '', $documento2[$aux2]['arquivo']);	
					}

					//Serve para comprar depois no view
					$documento2[$aux2]['idPessoa'] = 'null';

					//Recuperando a pessoa para exibicao
					$listaInstituicao = $minstituicao->InstituicaoEspecifica($documento2[$aux2]['idInstituicao']);

					//colocando o nome da pessoa na variavel
					foreach ($listaInstituicao as $value) {
						$documento2[$aux2]['nome'] = utf8_encode($value['nome']);
					}
				}
				$aux2++;
			}

			$diretorio2 -> close();

			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($documento2);

			//O que pesquisar no nome do arquivo
			$pesquisardocumento2 = array("/Apuracao/");

			//deixando apenas o arquivo correto no array
			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Se os nome forem (.) ou (..) entao exclui
				if ($documento2[$i]['arquivo'] == '.' || $documento2[$i]['arquivo'] == '..') {
					$arrayPosicaoExcluir[] = $i;	
				}

				foreach ($pesquisardocumento2 as $value) {
					if (preg_match($value, $documento2[$i]['arquivo'])) {
						$arrayPosicaoExcluir[] = $i;
					} else {
						//nao achou
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($documento2[$value]);
				}
			}

			//recupera a lista de nomes de vitima e responsaveis dessa unica vitima
			$listaPessoas2 = COcorrenciaAgressor::listaInstituicao($idOcorrencia);

			//verifica se o array dessa vitima com os seus reponsaveis
			//sao iguais o array dos documento2s, caso seja igual exibi se nao exibi
			foreach ($documento2 as $doc) {
				foreach ($listaPessoas2 as $value) {
					if ($doc['nome'] == $value['nome']) {
						$documentoFinal[] = $documento2;
					} else {
						return false;
					}
				}	
			}
			
		} else {
			return false;
		}

		//juntando os array e tirando array de dentro do array
		//[0]
		//	[1]
		foreach ($documento as $value) {
			$documentoFinal2[] = $value;
		}
		foreach ($documento2 as $value) {
			$documentoFinal2[] = $value;
		}

		return $documentoFinal2;
	}

	public static function postEnviarArquivoCadastrar($idOcorrencia, $post, $documento)
	{
		//Instancia
		$marquivo = new MArquivo;

		// verifica se foi enviado um arquivo
		if ( isset( $documento['name'] ) && $documento['error'] == 0 ) {
		    $arquivo_tmp = $documento['tmp_name'];
		    $nome = $documento['name'];
		 	
		 	//recuperando o ultimo id da tabela arquivo
		    $ultimoIdArquivo = $marquivo->ultimoRegistroArquivo();

		    // Pega a extensão
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    // Converte a extensão para minúsculo
		    $extensao = strtolower ( $extensao );

		    $selecionePessoa = substr($post['selecionePessoa'], 2, 10);
		    $isInstituicao = substr($post['selecionePessoa'], 0, 1);

		    // Somente PDF, .pdf;
		    if ( strstr ( '.pdf', $extensao ) ) {
		    	//nome da pasta da ocorrencia
		    	$pastaOcorrencia = "ocorrencia" . $idOcorrencia;

		        // Cria um nome único para esta imagem
		        // Evita que duplique as imagens no servidor.
		        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
		        $novoNome = ((int)$ultimoIdArquivo[0]['MAX(idArquivo)'] + 1) . $post['selecioneDocumento'] . $selecionePessoa . '.' . $extensao;

		        //Caso for pessoa fisica
		        if ($isInstituicao == "0") {
		        	$novoDiretorio = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidadesAgressor';

			        if (!is_dir($novoDiretorio)) {
			        	//criar pasta identidades
			        	mkdir($novoDiretorio);
			        }

			        // Concatena a pasta com o nome
		        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
								"ocorrencias" . DIRECTORY_SEPARATOR . 
								$pastaOcorrencia . DIRECTORY_SEPARATOR . 
								"identidadesAgressor" . DIRECTORY_SEPARATOR . $novoNome;
		        }

		        //Caso for instituicao
		        if ($isInstituicao == "1") {
		        	$novoDiretorio = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidadesInstituicao';

			        if (!is_dir($novoDiretorio)) {
			        	//criar pasta identidades
			        	mkdir($novoDiretorio);
			        }

			        // Concatena a pasta com o nome
		        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
								"ocorrencias" . DIRECTORY_SEPARATOR . 
								$pastaOcorrencia . DIRECTORY_SEPARATOR . 
								"identidadesInstituicao" . DIRECTORY_SEPARATOR . $novoNome;
		        }

		        // tenta mover o arquivo para o destino
		        if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$destino_final = str_replace($_SERVER['DOCUMENT_ROOT'], '', $destino);

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

		//Juntando os dois array em um so array chamado dados
		foreach ($listaAgressor as $value) {
			$dados[] = $value;
		}

		foreach ($listaInstituicao as $value) {
			$dados[] = $value;
		}

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

	public static function postEnviarArquivoCadastrarAtualizar($idOcorrencia, $post, $documento, $idArquivo)
	{	
		$marquivo = new MArquivo;

		$marquivo->atualizarStatus($idArquivo, 1);

		COcorrenciaAgressorEnviarArquivo::postEnviarArquivoCadastrar($idOcorrencia, $post, $documento);
	}

}

?>