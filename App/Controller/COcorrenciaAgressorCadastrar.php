<?php

namespace App\Controller;

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

			//Validar se o responsavel da vitima ja existe no banco de dados
			//Caso ele ja exista não precisara cadsatrar novamente
			//Apenas associar ele a vitima
			$listAllInstituicao = $minstituicao->listAll();

			//setando a variavel como false
			$instituicaoBloqueou = false;

			//Rodando pelo array de pessoas trazidas do banco de dados
			foreach ($listAllInstituicao as $value) {
				//Verificar se o cpf ja existe
				//Retira os pontos e tracos do cpf
				$cnpjInstituicaoBd = $validacao->replaceCpfBd($post['cpfInstituicao']);

				if ($cnpjInstituicaoBd == $value['cnpj']) {
					//id da pessoa ja existente
					$idInstituicao[0]["MAX(idInstituicao)"] = $value['idInstituicao'];

					//caso ele ache um cpf igual seta como true a variavel
					//e no if de baixo nao deixa rodar
					$instituicaoBloqueou = true;

					//Encerra o loop
					break;
				}
			}

			//caso nao tenha acha um cpf igual em cima
			//entao criar uma nova pessoa
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

	}//fim postAgressorCadastrar


}

?>