<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Model\MSolicitacao;
use \App\Model\MNotificacao;
use \App\Controller\CListaUsuario;
use \App\Controller\CDetalheOcorrencia;

class COcorrenciaNovaSolicitacao {

	public static function getNovaSolicitacaoVitima($idOcorrencia)
	{
		//recuperando dados do Controller CDetalheOcorrencia
		$dados = CDetalheOcorrencia::getOcorrenciaDetalhe($idOcorrencia);

		foreach ($dados as $value) {
			$novoArray[] = $value;
		}

		return $novoArray;
	}

	public static function getNovaSolicitacaoUsuario()
	{
		//recuperando dados do Controller CListaUsuario
		$dados = CListaUsuario::getListaUsuario();

		foreach ($dados as $value) {
			if ($value['nivelAcesso'] == '2' || $value['nivelAcesso'] == '3748') {
				$novoArray[] = $value;
			}
		}

		return $novoArray;
	}

	public static function postNovaSolicitacao($post, $idOcorrencia)
	{	
		//Instancia
		$msolicitacao = new MSolicitacao;
		$mnotificacao = new MNotificacao;
		$validacao = new Validacao;

		//Validando os post
		$post['assunto'] = $validacao->validarString($post['assunto'], 2);

		//processo de cadastrar a solicitacao
		//Cadastrar remetente
		$msolicitacao->cadastrarRemetente($idOcorrencia);
		
		//Cadastrar Destinatario
		$msolicitacao->cadastrarDestinatario($post);

		//Recuperando idRemetente e idDestinatario
		$idRemetente = $msolicitacao->ultimoRegistroRemetente();
		$idDestinatario = $msolicitacao->ultimoRegistroDestinatario();

		//Cadastrar Solicitcao
		$msolicitacao->cadastrarSolicitacao($post, $idOcorrencia, $idRemetente[0]['MAX(idRemetente)'], $idDestinatario[0]['MAX(idDestinatario)']);

		//Recuperando idSolicitacao
		$idSolicitacao = $msolicitacao->ultimoRegistroSolicitacao();

		//Cadastrar na tabela SolicitacaoVitimas
		$msolicitacao->cadastrarSolicitacaoVitimas($idSolicitacao[0]['MAX(idSolicitacao)'], $post);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfOcorrenciaNovaSolicitacao.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Solicitacao".$idSolicitacao[0]['MAX(idSolicitacao)']."Ocorrencia".$idOcorrencia."nova".$novoIdArquivo.".pdf";

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
		$marquivo->cadastrarArquivo('Nova Solicitação', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);

		//Fim Gerar PDF
		//////////////////////////////////////////////////////////////////////////////////////

		//Notificacao
		foreach ($listaUsuario as $value) {
			if ($value['idPessoa'] == null && $value['idInstituicao'] != null) {
				//Notificacao
				$mnotificacao->cadastrar("Nova Solicitação", "/ler-solicitacao/".$idSolicitacao[0]['MAX(idSolicitacao)']."/1", $post['para']);
			}

			if ($value['idInstituicao'] == null && $value['idPessoa'] != null) {
				//Notificacao
				$mnotificacao->cadastrar("Nova Solicitação", "/ler-solicitacao/".$idSolicitacao[0]['MAX(idSolicitacao)']."/0", $post['para']);
			}
		}
	}

}

?>