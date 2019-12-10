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

		$pastaOcorrencia = 'ocorrencia' . $idOcorrencia;

		$novoDiretorio = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidades';

        if (is_dir($novoDiretorio)) {

			//informando o local onde os arquivos estao
			$path = "ocorrencias".DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR."identidades";
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

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($documento[$value]);
				}
			}

			//recupera a lista de nomes de vitima e responsaveis dessa unica vitima
			$listaPessoas = COcorrenciaEnviarArquivo::getEnviarArquivoCadastrar($idVitima, $idOcorrencia);

			//verifica se o array dessa vitima com os seus reponsaveis
			//sao iguais o array dos documentos, caso seja igual exibi se nao exibi
			foreach ($documento as $doc) {
				foreach ($listaPessoas as $value) {
					if ($doc['nome'] == $value['nome']) {
						return $documento;
					} else {
						return false;
					}
				}	
			}
			
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
		 	
		 	//recuperando o ultimo id da tabela arquivo
		    $ultimoIdArquivo = $marquivo->ultimoRegistroArquivo();

		    // Pega a extensão
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    // Converte a extensão para minúsculo
		    $extensao = strtolower ( $extensao );
		 
		    // Somente PDF, .pdf;
		    if ( strstr ( '.pdf', $extensao ) ) {
		        // Cria um nome único para esta imagem
		        // Evita que duplique as imagens no servidor.
		        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
		        $novoNome = ((int)$ultimoIdArquivo[0]['MAX(idArquivo)'] + 1) . $post['selecioneDocumento'] . $post['selecionePessoa'] . '.' . $extensao;
		 	
		        $pastaOcorrencia = "ocorrencia" . $idOcorrencia;

		        $novoDiretorio = '.'.DIRECTORY_SEPARATOR.'ocorrencias'.DIRECTORY_SEPARATOR.$pastaOcorrencia.DIRECTORY_SEPARATOR.'identidades';

		        if (!is_dir($novoDiretorio)) {
		        	//criar pasta identidades
		        	mkdir($novoDiretorio);
		        }

		        // Concatena a pasta com o nome
	        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
							"ocorrencias" . DIRECTORY_SEPARATOR . 
							$pastaOcorrencia . DIRECTORY_SEPARATOR . 
							"identidades" . DIRECTORY_SEPARATOR . $novoNome;

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

		$marquivo->atualizarStatus($idArquivo, 1);

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