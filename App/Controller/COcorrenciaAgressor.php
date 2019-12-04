<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Agressor;
use \App\Classe\Validacao;
use \App\Model\MAgressor;
use \App\Model\MInstituicao;
use \App\Model\MPessoa;
use \App\Model\MEndereco;
use \App\Model\MContato;

class COcorrenciaAgressor {

	public static function postAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $post, $idAgressor)
	{
		//instanciando
		$magressor = new MAgressor;
		$validacao = new Validacao;

		//Mudando o valor de isExcluido para 1 que indica que foi excluido
		$magressor->excluirAgressor($idAgressor);

		//Cadastrando na tabela agressorExcluido
		$magressor->motivoAgressorExcluido($idAgressor, $idOcorrencia, $post);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfExcluirAgressor.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Agressor".$idAgressor."excluido".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

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
		$marquivo->cadastrarArquivo('Agressor Excluido', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
	}	

	public static function getAgressorExcluir($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao)
	{
		return COcorrenciaAgressor::getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);	
	}

	public static function getAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao)
	{
		return COcorrenciaAgressor::getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);
	}

	public static function postAgressorEditar($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao, $post)
	{
		//Instanciando objeto
		$mpessoa = new MPessoa;
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$magressor = new MAgressor;
		$minstituicao = new MInstituicao;
		$validacao = new Validacao;

		$listaAgressor = COcorrenciaAgressor::getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao);

		//Pegando o idContato e o idEndereco
		foreach ($listaAgressor as $value) {
			$idContato = $value['idContato'];
			$idEndereco = $value['idEndereco'];
			$idPessoa = $value['idPessoa'];
			$idInstituicao = $value['idInstituicao'];
		}

		//Validando os post
		$post['nomeAgressor'] = $validacao->validarString($post['nomeAgressor'], 1);
		$post['cepAgressor'] = $validacao->validarString($post['cepAgressor'], 3);
		$post['ruaAgressor'] = $validacao->validarString($post['ruaAgressor'], 2);
		$post['bairroAgressor'] = $validacao->validarString($post['bairroAgressor'], 2);
		$post['numeroAgressor'] = $validacao->validarString($post['numeroAgressor'], 3);
		$post['cidadeAgressor'] = $validacao->validarString($post['cidadeAgressor'], 1);
		$post['complementoAgressor'] = $validacao->validarString($post['complementoAgressor'], 2);

		//Ver se o campo nome nao esta vazio
		if (!isset($post['nomeAgressor']) || $post['nomeAgressor'] === '') {
			Validacao::setMsgError("Informe o Nome.");
	        header('Location: /ocorrencia-agressor-editar/'.$idOcorrencia.'/'.$isInstituicao.'/'.$idOcorrenciaAgressor);
	        exit;
		}

		//separar o que vai ser feito pq tem dois templates diferentes agressor e instituicao
		if ($isInstituicao == 0) {
			//recuperando o idPessoa
			foreach ($listaAgressor as $value) {
				$idPessoa = $value['idPessoa'];
			}

			//Pessoa Fisica
			$validaCPF = $validacao->validaCPF($post['cpfAgressor']);

			if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
				Validacao::setMsgError("CPF Inválido.");
		        header('Location: /ocorrencia-agressor-editar/'.$idOcorrencia.'/'.$isInstituicao.'/'.$idOcorrenciaAgressor);
		        exit;
			}

			//Nao pode cadastrar pessoas com cpf iguais
			//Pelo cpf da para saber se tem duas pessoas com mais de um registro
			$cpfIgual = $mpessoa->cpfIgualUpdate($idPessoa);

			foreach ($cpfIgual as $cpf) {
				if ($validacao->replaceCpfBd($post['cpfAgressor']) == $cpf['cpf']) {
					Validacao::setMsgError("Este cpf já está cadastrado.");
			        header('Location: /ocorrencia-agressor-editar/'.$idOcorrencia.'/'.$isInstituicao.'/'.$idOcorrenciaAgressor);
			        exit;
				}
			}

			//Atualizando os dados
			$mpessoa->update($post, $idPessoa, 'agressor');
			$mcontato->update($post, $idContato, 'agressor');
			$mendereco->update($post, $idEndereco, 'agressor');

		} else {
			//recuperando o idInstituicao
			foreach ($listaAgressor as $value) {
				$idInstituicao = $value['idInstituicao'];
			}

			//Instituicao
			$validaCNPJ = $validacao->validaCnpj($post['cnpjAgressor']);

			if ($validaCNPJ === false || !isset($validaCNPJ) || $validaCNPJ === '') {
				Validacao::setMsgError("CNPJ Inválido.");
		        header('Location: /ocorrencia-agressor-editar/'.$idOcorrencia.'/'.$isInstituicao.'/'.$idOcorrenciaAgressor);
		        exit;
			}

			//Nao pode cadastrar pessoas com cpf iguais
			//Pelo cpf da para saber se tem duas pessoas com mais de um registro
			$cnpjIgual = $minstituicao->cnpjIgualUpdate($idInstituicao);

			foreach ($cnpjIgual as $cnpj) {
				if ($validacao->replaceCnpjBd($post['cnpjAgressor']) == $cnpj['cnpj']) {
					Validacao::setMsgError("Este cnpj já está cadastrado.");
			        header('Location: /ocorrencia-agressor-editar/'.$idOcorrencia.'/'.$isInstituicao.'/'.$idOcorrenciaAgressor);
			        exit;
				}
			}

			//Atualizando os dados
			$minstituicao->update($post, $idInstituicao);
			$mcontato->update($post, $idContato, 'agressor');
			$mendereco->update($post, $idEndereco, 'agressor');

		} // Fim else isInstituicao

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfEditarAgressor.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Agressor".$idOcorrenciaAgressor."editado".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

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
		$marquivo->cadastrarArquivo('Agressor Editado', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);

	}

	public static function getListaAgressor($idOcorrencia)
	{
		//Reucperando os array ja formatados
		$listaAgressor = COcorrenciaAgressor::listaAgressor($idOcorrencia);
		$listaInstituicao = COcorrenciaAgressor::listaInstituicao($idOcorrencia);

		//Pegar tamanho do array
		$tamanhoArrayAgressor = count($listaAgressor);
		$tamanhoArrayInstituicao = count($listaInstituicao);

		//se CPF ou CNPJ
		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			$listaAgressor[$i]['isCpf'] = '1';
		}

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			$listaInstituicao[$i]['isCpf'] = '0';
		}

		//Juntando os dois arary
		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			$listaCompleta[] = $listaAgressor[$i];
		}

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			$listaCompleta[] = $listaInstituicao[$i];
		}

		if (isset($listaCompleta) && $listaCompleta != null && $listaCompleta != "") {
			return $listaCompleta;
		} else {
			return false;
		}
	}

	public static function getAgressorDetalhe($idOcorrenciaAgressor, $idOcorrencia, $isInstituicao)
	{	
		//Verificar se e instituicao ou pessoa fisica
		if ($isInstituicao == "0") {
			$listaAgressor = COcorrenciaAgressor::listaAgressor($idOcorrencia, "unico", $idOcorrenciaAgressor);	
		}

		if ($isInstituicao == "1") {
			$listaAgressor = COcorrenciaAgressor::listaInstituicao($idOcorrencia, "unico", $idOcorrenciaAgressor);
		}
		
		return $listaAgressor;
	}

	protected function listaAgressor($idOcorrencia, $complemento = "completo", $idOcorrenciaAgressor = "")
	{
		//Instancia
		$magressor = new MAgressor;
		$validacao = new Validacao;

		//Recuperando dados
		if ($complemento == "unico") {
			$listaAgressor = $magressor->listaAgressorEspecifico($idOcorrencia, $idOcorrenciaAgressor);
		}

		if ($complemento == "completo") {
			$listaAgressor = $magressor->listaAgressor($idOcorrencia);
		}

		//Tamanho do array
		$tamanhoArrayAgressor = count($listaAgressor);

		for ($i = 0; $i < $tamanhoArrayAgressor; $i++) {
			if ($listaAgressor[$i]['isExcluido'] == '1') {
				$agressorExcluido = $magressor->selecionaMotivoAgressorExcluido($listaAgressor[$i]['idAgressor'], $idOcorrencia);
				
				foreach ($agressorExcluido as $value) {
					$listaAgressor[$i]['motivoExcluido'] = utf8_encode($value['motivo']);	
				}
			}

			//validacao
			$listaAgressor[$i]['nome'] = utf8_encode($listaAgressor[$i]['nome']);
			$listaAgressor[$i]['rua'] = utf8_encode($listaAgressor[$i]['rua']);
			$listaAgressor[$i]['bairro'] = utf8_encode($listaAgressor[$i]['bairro']);
			$listaAgressor[$i]['cidade'] = utf8_encode($listaAgressor[$i]['cidade']);
			$listaAgressor[$i]['complemento'] = utf8_encode($listaAgressor[$i]['complemento']);
			$listaAgressor[$i]['celular'] = $validacao->replaceCelularView(utf8_encode($listaAgressor[$i]['celular']));
			$listaAgressor[$i]['fixo'] = $validacao->replaceTelefoneFixoView(utf8_encode($listaAgressor[$i]['fixo']));
			$listaAgressor[$i]['cpf'] = $validacao->replaceCpfView(utf8_encode($listaAgressor[$i]['cpf']));
			$listaAgressor[$i]['rg'] = $validacao->replaceSemDigitoRg($listaAgressor[$i]['rg']);
			$listaAgressor[$i]['rgDigito'] = $validacao->replaceDigitoRg($listaAgressor[$i]['rg']);

			if ($listaAgressor[$i]['dataNasc'] == null) {
				//mostra nada
			} else {
				$listaAgressor[$i]['dataNasc'] = $validacao->replaceDataView(utf8_encode($listaAgressor[$i]['dataNasc']));
			}
		}

		return $listaAgressor;
	}

	protected function listaInstituicao($idOcorrencia, $complemento = "completo", $idOcorrenciaAgressor = "")
	{
		//Instancia
		$minstituicao = new MInstituicao;
		$magressor = new MAgressor;
		$validacao = new Validacao;

		//Recuperando dados
		if ($complemento == "unico") {
			$listaInstituicao = $minstituicao->listaInstituicaoEspecifica($idOcorrencia, $idOcorrenciaAgressor);
		}

		if ($complemento == "completo") {
			$listaInstituicao = $minstituicao->listaInstituicao($idOcorrencia);
		}

		//Tamanho do array
		$tamanhoArrayInstituicao = count($listaInstituicao);

		for ($i = 0; $i < $tamanhoArrayInstituicao; $i++) {
			if ($listaInstituicao[$i]['isExcluido'] == '1') {
				$agressorExcluido = $magressor->selecionaMotivoAgressorExcluido($listaInstituicao[$i]['idAgressor'], $idOcorrencia);
				
				foreach ($agressorExcluido as $value) {
					$listaInstituicao[$i]['motivoExcluido'] = utf8_encode($value['motivo']);
				}
			}

			//validacao
			$listaInstituicao[$i]['nome'] = utf8_encode($listaInstituicao[$i]['nome']);
			$listaInstituicao[$i]['rua'] = utf8_encode($listaInstituicao[$i]['rua']);
			$listaInstituicao[$i]['bairro'] = utf8_encode($listaInstituicao[$i]['bairro']);
			$listaInstituicao[$i]['cidade'] = utf8_encode($listaInstituicao[$i]['cidade']);
			$listaInstituicao[$i]['complemento'] = utf8_encode($listaInstituicao[$i]['complemento']);
			$listaInstituicao[$i]['celular'] = $validacao->replaceCelularView(utf8_encode($listaInstituicao[$i]['celular']));
			$listaInstituicao[$i]['fixo'] = $validacao->replaceTelefoneFixoView(utf8_encode($listaInstituicao[$i]['fixo']));
			$listaInstituicao[$i]['cnpj'] = $validacao->replaceCnpjView(utf8_encode($listaInstituicao[$i]['cnpj']));
		}

		return $listaInstituicao;
	}

}

?>