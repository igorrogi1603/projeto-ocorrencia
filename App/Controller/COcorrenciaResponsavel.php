<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Model\MOcorrencia;
use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MPessoa;
use \App\Model\MUsuario;
use \App\Model\MResponsavel;
use \App\Model\MArquivo;
use \App\Classe\Ocorrencia;
use \App\Classe\Pessoa;
use \App\Classe\Endereco;
use \App\Classe\Contato;
use \App\Classe\Validacao;

class COcorrenciaResponsavel {

	public static function getDetalheResponsavelVitima($idPessoaResponsavel)
	{
		return COcorrenciaResponsavel::validacaoResponsavelCompleto($idPessoaResponsavel);
	}

	public static function getListaResponsavelVitima($idVitima, $idOcorrencia)
	{
		return COcorrenciaResponsavel::validacaoVitimasEditar($idVitima, $idOcorrencia);	
	}

	public static function getOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel)
	{
		return COcorrenciaResponsavel::responsavelEspecifico($idVitima, $idOcorrencia, $idPessoaResponsavel);
	}

	public static function getOcorrenciaResponsavelVitimaExcluir($idResponsavelApuracao, $post, $idCriarApuracao, $idOcorrencia, $idVitima, $idPessoaResponsavel)
	{	
		$mresponsavel = new MResponsavel;

		$mresponsavel->updateIsAindaResponsavel(0, $idResponsavelApuracao);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfExcluirResponsavel.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "ResponsavelVitima".$idResponsavelApuracao."excluir".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

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
		$marquivo->cadastrarArquivo('Responsavel Excluido', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);

		//Cadastrar na Tabela Excluir Responsavel
		$mresponsavel->cadastrarMotivoDescartarResponsavel($idResponsavelApuracao, $post, $idCriarApuracao, $_SESSION['User']['idUsuario']);
	}

	public static function postOcorrenciaResponsavelVitimaEditar($idVitima, $idOcorrencia, $idPessoaResponsavel, $post)
	{
		//Instanciando objeto
		$mpessoa = new MPessoa;
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$mresponsavel = new MResponsavel;
		$validacao = new Validacao;

		//recuperando o responsavel especifico
		$listaResponsavel = COcorrenciaResponsavel::responsavelEspecifico($idVitima, $idOcorrencia, $idPessoaResponsavel);

		//Pegando o idContato e o idEndereco do Responsavel
		foreach ($listaResponsavel as $value) {
			$idContato = $value['idContatoResponsavel'];
			$idEndereco = $value['idEnderecoResponsavel'];
		}

		//Validando os post
		$post['nomeResponsavel'] = $validacao->validarString($post['nomeResponsavel'], 1);
		$validaCPF = $validacao->validaCPF($post['cpfResponsavel']);
		$post['cepResponsavel'] = $validacao->validarString($post['cepResponsavel'], 3);
		$post['ruaResponsavel'] = $validacao->validarString($post['ruaResponsavel'], 2);
		$post['bairroResponsavel'] = $validacao->validarString($post['bairroResponsavel'], 2);
		$post['numeroResponsavel'] = $validacao->validarString($post['numeroResponsavel'], 3);
		$post['cidadeResponsavel'] = $validacao->validarString($post['cidadeResponsavel'], 1);
		$post['complementoResponsavel'] = $validacao->validarString($post['complementoResponsavel'], 2);

		if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
			Validacao::setMsgError("CPF Inválido.");
	        header('Location: /ocorrencia-responsavel-vitima-editar/'.$idVitima.'/'.$idOcorrencia.'/'.$idPessoaResponsavel);
	        exit;
		}

		if (!isset($post['nomeResponsavel']) || $post['nomeResponsavel'] === '') {
			Validacao::setMsgError("Informe o Nome da Vítima.");
	        header('Location: /ocorrencia-responsavel-vitima-editar/'.$idVitima.'/'.$idOcorrencia.'/'.$idPessoaResponsavel);
	        exit;
		}

		//Nao pode cadastrar pessoas com cpf iguais
		//Pelo cpf da para saber se tem duas pessoas com mais de um registro
		$cpfIgual = $mpessoa->cpfIgualUpdate($idPessoaResponsavel);

		foreach ($cpfIgual as $cpf) {
			if ($validacao->replaceCpfBd($post['cpfResponsavel']) == $cpf['cpf']) {
				Validacao::setMsgError("Este cpf já está cadastrado.");
		        header('Location: /ocorrencia-responsavel-vitima-editar/'.$idVitima.'/'.$idOcorrencia.'/'.$idPessoaResponsavel);
		        exit;
			}
		}

		//caso o radio for 3 entao verificar se o campo "outro" nao esta vazio
		if (!isset($post['responsavelOutro']) || $post['responsavelOutro'] == "") {
			Validacao::setMsgError("Não foi preenchido o campo outro.");
	        header('Location: /ocorrencia-responsavel-vitima-editar/'.$idVitima.'/'.$idOcorrencia.'/'.$idPessoaResponsavel);
	        exit;
		}

		//Caso for pai ou mae deixar vazio o campo "outro"
		if ($post['responsavelRadio'] == 1 || $post['responsavelRadio'] == 2) {
			$post['responsavelOutro'] = "";
		}

		//Atualizando os dados
		$mpessoa->update($post, $idPessoaResponsavel, 'responsavel');
		$mcontato->update($post, $idContato, 'responsavel');
		$mendereco->update($post, $idEndereco, 'responsavel');
		$mresponsavel->updateResponsavelApuracao($post, $idPessoaResponsavel);

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfEditarResponsavel.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "ResponsavelVitima".$idPessoaResponsavel."editado".$novoIdArquivo.".pdf";

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
		$marquivo->cadastrarArquivo('Responsavel Editado', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
	}

	//Cadastrar um novo responsavel para vitima
	public static function postCadastrarResponsavelVitima($idVitima, $idOcorrencia, $post)
	{
		$mpessoa = new Mpessoa;
		$mendereco = new MEndereco;
		$mcontato = new MContato;
		$musuario = new MUsuario;
		$mresponsavel = new MResponsavel;
		$marquivo = new MArquivo;
		$validacao = new Validacao;

		//Validacao dos campos do formulario (post)
		if ($post['nomeResponsavel'] == "") {
			Validacao::setMsgError("Informe o nome do responsável que está vazio.");
	        header('Location: /ocorrencia-responsavel-vitima-cadastrar/'.$idVitima.'/'.$idOcorrencia);
	        exit;			
		}

		$validaCPF = $validacao->validaCPF($post['cpfResponsavel']);

		if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
			Validacao::setMsgError("CPF do responsável está inválido.");
	        header('Location: /ocorrencia-responsavel-vitima-cadastrar/'.$idVitima.'/'.$idOcorrencia);
	        exit;
		}

		//garantir se for pai ou mae nao salvar o campo "Outro"
		if ($post['responsavelRadio'] == 1 || $post['responsavelRadio'] == 2) {
			//zerar o campo caso tenha algo nele para nao cadastrar no banco
			$post['responsavelOutro'] = "";
		}

		//Validar se o responsavel da vitima ja existe no banco de dados
		//Caso ele ja exista não precisara cadsatrar novamente
		//Apenas associar ele a vitima
		$listAllPessoa = $mpessoa->listAll();

		//setando a variavel como false
		$usuarioResponsavelBloqueou = false;

		//Rodando pelo array de pessoas trazidas do banco de dados
		foreach ($listAllPessoa as $value) {
			//Verificar se o cpf ja existe
			//Retira os pontos e tracos do cpf
			$cpfResponsavelBd = $validacao->replaceCpfBd($post['cpfResponsavel']);

			if ($cpfResponsavelBd == $value['cpf']) {
				//id da pessoa ja existente
				$idPessoa[0]["MAX(idPessoa)"] = $value['idPessoa'];

				//Caso for um usuario bloquear o usuario
				//Pesquisar todos os usuarios no banco para comparar
				$listAllUsuario = $musuario->listAll();

				//percorrer o array usuario
				foreach ($listAllUsuario as $valueUser) {
					//verificar se a pessoa e um usuario
					if ($idPessoa[0]["MAX(idPessoa)"] == $valueUser['idPessoa']) {
						//e um usuario, entao bloquear o acesso dele
						$musuario->bloquearUsuario($valueUser['idUsuario']);
					}
				}

				//caso ele ache um cpf igual seta como true a variavel
				//e no if de baixo nao deixa rodar
				$usuarioResponsavelBloqueou = true;

				//Encerra o loop
				break;
			}
		}

		//caso nao tenha acha um cpf igual em cima
		//entao criar uma nova pessoa
		if ($usuarioResponsavelBloqueou != true) {
			//Cadastrando o contato e endereco do responsavel
			$mcontato->cadastrar($post, "responsavel");
			$mendereco->cadastrar($post, "responsavel");

			//recuperando o ultimo id de contato e endereco
			$idContato = $mcontato->ultimoRegistro();
			$idEndereco = $mendereco->ultimoRegistro();

			//Cadastrando o responsavel como uma pessoa
			$mpessoa->cadastrar($post, $idContato, $idEndereco, "responsavel");

			//recuperando o ultimo id da pessoa
			$idPessoa = $mpessoa->ultimoRegistro();
		}

		//Cadastrando na tabela responsavelApuracao
		$mresponsavel->cadastrar($idPessoa, "ocorrencia", $post);

		//recuperando o ultimo id do responsavel da vitima
		$idResponsavel = $mresponsavel->ultimoRegistro();

		//CADASTRAR NA TABELA ResponsavelVitimas
		$mresponsavel->cadastrarResponsavelVitimas($idResponsavel, $idVitima, "ocorrencia");

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfNovoResponsavel.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "ResponsavelVitima".$idResponsavel[0]['MAX(idResponsavelApuracao)']."novo".$novoIdArquivo.".pdf";

		$nomePasta = "ocorrencia".$idOcorrencia;

		//Para onde vai o pdf
		$destino = ".".DIRECTORY_SEPARATOR."ocorrencias".DIRECTORY_SEPARATOR.$nomePasta.DIRECTORY_SEPARATOR;

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
		$marquivo->cadastrarArquivo('Novo Responsavel', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);
	}	



	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	//Responsavel especifico
	protected function responsavelEspecifico($idVitima, $idOcorrencia, $idPessoaResponsavel)
	{
		$listaResponsavel = COcorrenciaResponsavel::validacaoVitimasEditar($idVitima, $idOcorrencia);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaResponsavel);

		//Deixar apenas o array do responsavel
		for ($i = 0; $i < $tamanhoArray; $i++) {
			//Se os id forem diferentes entao exclui para nao vir outra pessoa junto
			if ($idPessoaResponsavel != $listaResponsavel[$i]['idPessoaResponsavel']) {
				unset($listaResponsavel[$i]);
			}
		}

		return $listaResponsavel;
	}

	//Validar os campos do responsavel
	//Tras o endereco contato e dados do responsavel especifico
	protected function validacaoResponsavelCompleto($idPessoaResponsavel)
	{
		$mpessoa = new MPessoa;
		$validacao = new Validacao;

		$listaResponsavel = $mpessoa->pessoaEspecifica($idPessoaResponsavel);

		//Pega o tamanho do arry para usar no for
		$tamanhoArray = count($listaResponsavel);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$listaResponsavel[$i]['nome'] = utf8_encode($listaResponsavel[$i]['nome']);
			$listaResponsavel[$i]['cpf'] = $validacao->replaceCpfView(utf8_encode($listaResponsavel[$i]['cpf']));
			$listaResponsavel[$i]['rg'] = $validacao->replaceSemDigitoRg($listaResponsavel[$i]['rg']);
			$listaResponsavel[$i]['rua'] = utf8_encode($listaResponsavel[$i]['rua']);
			$listaResponsavel[$i]['bairro'] = utf8_encode($listaResponsavel[$i]['bairro']);
			$listaResponsavel[$i]['cidade'] = utf8_encode($listaResponsavel[$i]['cidade']);
			$listaResponsavel[$i]['estado'] = strtoupper(utf8_encode($listaResponsavel[$i]['estado']));
			$listaResponsavel[$i]['complemento'] = utf8_encode($listaResponsavel[$i]['complemento']);
			$listaResponsavel[$i]['fixo'] = $validacao->replaceTelefoneFixoView(utf8_encode($listaResponsavel[$i]['fixo']));
			$listaResponsavel[$i]['celular'] = $validacao->replaceCelularView(utf8_encode($listaResponsavel[$i]['celular']));
			$listaResponsavel[$i]['cep'] = $validacao->replaceCepView(utf8_encode($listaResponsavel[$i]['cep']));
			
			if ($listaResponsavel[$i]['dataNasc'] == null) {
				//mostra nada
			} else {
				$listaResponsavel[$i]['dataNasc'] = $validacao->replaceDataView(utf8_encode($listaResponsavel[$i]['dataNasc']));
			}
		}

		return $listaResponsavel;
	}

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