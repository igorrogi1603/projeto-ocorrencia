<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Model\MOcorrencia;
use \App\Model\MApuracao;

class COcorrenciaDescricao {

	public static function getOcorrenciaDescricao($idOcorrencia)
	{
		//instancia
		$mocorrencia = new MOcorrencia;

		//Trazer a lista completa da ocorrencia
		$listaOcorrencia = $mocorrencia->listaOcorrencia($idOcorrencia);

		$tamanhoArray = count($listaOcorrencia);

		//Nao duplicar array
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Verifica sea posicao que queremos guardar existe
			if (isset($listaOcorrencia[$i])) {
				//se existe guarda em id
				$id = $listaOcorrencia[$i]['idOcorrencia'];
			}
			//o for inicia na proxima posicao do array 
			//Para nao comparar com a mesma posicao
			for ($a = $i+1; $a < $tamanhoArray; $a++) {
				//Se os id forem iguais entao exclui para nao duplicar
				if ($id == $listaOcorrencia[$a]['idOcorrencia']) {
					$arrayPosicaoExcluir[] = $a;
				}
			}
		}

		if (isset($arrayPosicaoExcluir)) {
			//exclui posissoes iguais
			foreach ($arrayPosicaoExcluir as $value) {
				unset($listaOcorrencia[$value]);
			}
		}

		//formatando as string 
		for ($i = 0; $i < $tamanhoArray; $i++) {
			if (isset($listaOcorrencia[$i])) {
				$listaOcorrencia[$i]['descricao'] = utf8_encode($listaOcorrencia[$i]['descricao']);
				$listaOcorrencia[$i]['tipoApuracao'] = utf8_encode($listaOcorrencia[$i]['tipoApuracao']);
			}
		}

		return $listaOcorrencia;
	}

	public static function postOcorrenciaDescricaoEditar($idOcorrencia, $idApuracao, $post)
	{	
		//instancia
		$mocorrencia = new MOcorrencia;
		$mapuracao = new MApuracao;

		//validacao de campos
		if (!isset($post['tipoApuracao']) || $post['tipoApuracao'] === '') {
			Validacao::setMsgError("Informe o tipo da ocorrência.");
	        header('Location: /ocorrencia-descricao-editar/'.$idOcorrencia);
	        exit;
		}

		if (!isset($post['descricaoApuracao']) || $post['descricaoApuracao'] === '') {
			Validacao::setMsgError("Informe o descrição da ocorrência.");
	        header('Location: /ocorrencia-descricao-editar/'.$idOcorrencia);
	        exit;
		}

		//update descricao e tipo
		$mapuracao->updateDescricaoApuracao($idApuracao, $post);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfEditarDescricaoOcorrencia.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Ocorrencia".$idOcorrencia."editado".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."Arquivos".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

		//Instancia o mpdf
		$mpdf = new Mpdf();	

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
		$marquivo->cadastrarArquivo('Descricao Editada', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
	}

}

?>