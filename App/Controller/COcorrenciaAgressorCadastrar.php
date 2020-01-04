<?php

namespace App\Controller;

use \Mpdf\Mpdf;

use \App\Classe\Validacao;
use \App\Model\MPessoa;
use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MAgressor;
use \App\Model\MInstituicao;
use \App\Model\Musuario;

class COcorrenciaAgressorCadastrar {

	public static function postAgressorCadastrar($idOcorrencia, $post)
	{
		//instancia
		$mpessoa = new MPessoa;
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$magressor = new MAgressor;
		$musuario = new Musuario;
		$minstituicao = new MInstituicao;
		$validacao = new Validacao;
		
		//validando post
		//Instituicao
		if ($post['agressorRadio'] == 1) {
			if ($post['nomeInstituicao'] == "") {
				Validacao::setMsgError("Informe o nome da Instituição, está vazio.");
		        header('Location: /ocorrencia-agressor-cadastrar/'.$idOcorrencia);
		        exit;			
			}

			$validaCNPJ = $validacao->validaCnpj($post['cnpjInstituicao']);

			if ($validaCNPJ === false || !isset($validaCNPJ) || $validaCNPJ === '') {
				Validacao::setMsgError("CNPJ inválido ou vazio.");
		        header('Location: /ocorrencia-agressor-cadastrar/'.$idOcorrencia);
		        exit;
			}

			//Validar se ja existe no banco de dados
			//Caso ele ja exista não precisara cadsatrar novamente
			$listAllInstituicao = $minstituicao->listAll();

			//setando a variavel como false
			$instituicaoBloqueou = false;

			//Rodando pelo array de instituicao trazidas do banco de dados
			foreach ($listAllInstituicao as $value) {
				//Verificar se o cnpj ja existe
				//Retira os pontos e tracos do cpf
				$cnpjInstituicaoBd = $validacao->replaceCnpjBd($post['cnpjInstituicao']);

				//radioQualInstituicao
				//1 = Instituicao Publica
				//2 = Pessoa Juridica				

				//Pessoa juridica nao pode repetir o cnpj
				if (isset($post['radioQualInstituicao']) && $post['radioQualInstituicao'] == 2) {
					if ($cnpjInstituicaoBd == $value['cnpj']) {
						//id da instituicao ja existente
						$idInstituicao[0]["MAX(idInstituicao)"] = $value['idInstituicao'];

						//caso ele ache um cnpj igual seta como true a variavel
						//e no if de baixo nao deixa rodar
						$instituicaoBloqueou = true;

						//Encerra o loop
						break;
					}
				}

				//Instituicao Publica usa o mesmo cnpj mas com o subnome diferente
				if (isset($post['radioQualInstituicao']) && $post['radioQualInstituicao'] == 1) {
					if ($cnpjInstituicaoBd == $value['cnpj']) {
						//Verifica se o post subnome existe
						if (!isset($post['subnomeInstituicao']) || $post['subnomeInstituicao'] === '') {
							Validacao::setMsgError("Informe o subnome da Instituição Pública.");
					        header('Location: /ocorrencia-agressor-cadastrar/'.$idOcorrencia);
					        exit;
						}

						//Se achou um cnpj de uma Instituicao Pulbica que pode se repetir
						//Verificar se o subnome é igual
						//strtolower para nao ter problema de verificar a string com 
						//alguma diferenca de letra maiuscula e minuscula
						if (strtolower($post['subnomeInstituicao']) == strtolower($value['subnome'])) {
							//Entao se o cnpj for igual e subnome for igual entao ja esta cadastrado
							//id da instituicao ja existente
							$idInstituicao[0]["MAX(idInstituicao)"] = $value['idInstituicao'];

							//caso ele ache um cnpj igual seta como true a variavel
							//e no if de baixo nao deixa rodar
							$instituicaoBloqueou = true;

							//Encerra o loop
							break;
						}
					}
				}
			}

			//caso nao tenha acha um cnpj igual em cima
			//entao criar uma nova instituicao
			if ($instituicaoBloqueou != true) {
				//Cadastrando o contato e endereco do responsavel
				$mcontato->cadastrar($post, "instituicao");
				$mendereco->cadastrar($post, "instituicao");

				//recuperando o ultimo id de contato e endereco
				$idContato = $mcontato->ultimoRegistro();
				$idEndereco = $mendereco->ultimoRegistro();

				//Cadastrando o responsavel como uma pessoa
				$minstituicao->cadastrar($post, $idEndereco, $idContato);

				//recuperando o ultimo id da pessoa
				$idInstituicao = $minstituicao->ultimoRegistro();
			}

			//Cadastrando na tabela Agressor
			$magressor->cadastrar($idInstituicao, $post, "instituicao");

			//recuperando o ultimo id do Agressor
			$idAgressor = $magressor->ultimoRegistro();

			//CADASTRAR NA TABELA OcorrenciaAgressor
			$magressor->cadastrarOcorrenciaAgressor($idAgressor, $idOcorrencia);

		} // Fim IF Instituicao

		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------

		//Agressor
		if ($post['agressorRadio'] == 2) {
			if ($post['nomeAgressor'] == "") {
				Validacao::setMsgError("Informe o nome do Agressor, está vazio.");
		        header('Location: /ocorrencia-agressor-cadastrar/'.$idOcorrencia);
		        exit;			
			}

			$validaCPF = $validacao->validaCPF($post['cpfAgressor']);

			if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
				Validacao::setMsgError("CPF inválido ou vazio.");
		        header('Location: /ocorrencia-agressor-cadastrar/'.$idOcorrencia);
		        exit;
			}

			//Validar se o responsavel da vitima ja existe no banco de dados
			//Caso ele ja exista não precisara cadsatrar novamente
			//Apenas associar ele a vitima
			$listAllPessoa = $mpessoa->listAll();

			//setando a variavel como false
			$usuarioAgressorBloqueou = false;

			//Rodando pelo array de pessoas trazidas do banco de dados
			foreach ($listAllPessoa as $value) {
				//Verificar se o cpf ja existe
				//Retira os pontos e tracos do cpf
				$cpfAgressorBd = $validacao->replaceCpfBd($post['cpfAgressor']);

				if ($cpfAgressorBd == $value['cpf']) {
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
					$usuarioAgressorBloqueou = true;

					//Encerra o loop
					break;
				}
			}

			//caso nao tenha acha um cpf igual em cima
			//entao criar uma nova pessoa
			if ($usuarioAgressorBloqueou != true) {
				//Cadastrando o contato e endereco do responsavel
				$mcontato->cadastrar($post, "agressor");
				$mendereco->cadastrar($post, "agressor");

				//recuperando o ultimo id de contato e endereco
				$idContato = $mcontato->ultimoRegistro();
				$idEndereco = $mendereco->ultimoRegistro();

				//Cadastrando o responsavel como uma pessoa
				$mpessoa->cadastrar($post, $idContato, $idEndereco, "agressor");

				//recuperando o ultimo id da pessoa
				$idPessoa = $mpessoa->ultimoRegistro();
			}

			//Cadastrando na tabela Agressor
			$magressor->cadastrar($idPessoa, $post, "agressor");

			//recuperando o ultimo id do Agressor
			$idAgressor = $magressor->ultimoRegistro();

			//CADASTRAR NA TABELA OcorrenciaAgressor
			$magressor->cadastrarOcorrenciaAgressor($idAgressor, $idOcorrencia);

		}//Fim IF Agressor

		//--------------------------------------------------------
		//Gerar o PDF
		//Buscando o conteudo do pdf
		require_once('./App/Views-pdf/PdfNovoAgressor.php');

		//Resgata o arquivo criado
		//PRECISA DE UM CONTADOR PARA DIFERENCIAR QUANDO FOR EDITADO MAIS QUE UMA VEZ
		$idArquivoAnterior = $marquivo->ultimoRegistroArquivo();
		$novoIdArquivo = $idArquivoAnterior[0]["MAX(idArquivo)"] + 1;

		//Nome do arquivo final
		$arquivo = "Agressor".$idAgressor[0]["MAX(idAgressor)"]."novo".$novoIdArquivo.".pdf";

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
		$marquivo->cadastrarArquivo('Novo Agressor', $url);

		//Resgata o arquivo criado
		$idArquivo = $marquivo->ultimoRegistroArquivo();

		//registra na tabela tb_arquivosProcessoOcorrencia
		$marquivo->cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo[0]["MAX(idArquivo)"]);

	}//fim postAgressorCadastrar


}

?>