<?php

namespace App\Controller;

use \App\Classe\Validacao;
use \App\Model\MArquivo;

class COcorrenciaArquivoExterno {

	public static function postEnviarAquivoExterno($idOcorrencia, $post, $documento)
	{
		//Instancia
		$marquivo = new MArquivo;

		//validacao de campos
		if (!isset($post['tipo']) || $post['tipo'] === '') {
			Validacao::setMsgError("Informe o tipo do arquivo.");
	        header('Location: /ocorrencia-arquivo-externo/'.$idOcorrencia);
	        exit;
		}

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
		        $novoNome = ((int)$ultimoIdArquivo[0]['MAX(idArquivo)'] + 1) . $post['tipo'] . '.' . $extensao;

		        //nome da pasta da ocorrencia onde vai mandar o arquivo
		        $nomePasta = "ocorrencia".$idOcorrencia;

		        // Concatena a pasta com o nome
	        	$destino = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
							"ocorrencias" . DIRECTORY_SEPARATOR . 
							$nomePasta . DIRECTORY_SEPARATOR . $novoNome;
		        

		        // tenta mover o arquivo para o destino
		        if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		        	$destino_final = str_replace($_SERVER['DOCUMENT_ROOT'], '', $destino);

					//Cadastrando na tabela tb_arquivos
					$marquivo->cadastrarArquivo($post['tipo'], $destino_final);

					//Resgata o arquivo criado
					$idArquivoNovo = $marquivo->ultimoRegistroArquivo();

					//registra na tabela tb_arquivosProcessoOcorrencia
					$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivoNovo[0]["MAX(idArquivo)"]);

		        } else {
		            Validacao::setMsgError("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.");
			        header('Location: /ocorrencia-arquivo-externo/'.$idOcorrencia);
			        exit;
		        }
		    } else {
		        Validacao::setMsgError("Você pode enviar apenas arquivos PDF");
		        header('Location: /ocorrencia-arquivo-externo/'.$idOcorrencia);
		        exit;
		    }
		} else {
		    Validacao::setMsgError("Você não enviou nenhum arquivo!");
	        header('Location: /ocorrencia-arquivo-externo/'.$idOcorrencia);
	        exit;
		}
	}

}

?>