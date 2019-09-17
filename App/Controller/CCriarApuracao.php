<?php

namespace App\Controller;

use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Model\MApuracao;
use \App\Model\MPessoa;
use \App\Model\MEndereco;
use \App\Model\MContato;
use \App\Model\MResponsavel;
use \App\Model\MVitima;
use \App\Model\MUsuario;

class CCriarApuracao {

	public static function postCriarApuracao($post)
	{	
		//Instanciar as Classes
		$validacao = new Validacao;

		//Instaciar os Models
		$mapuracao = new MApuracao;
		$mpessoa = new MPessoa;
		$mendereco = new MEndereco;
		$mcontato = new MContato;
		$mresponsavel = new MResponsavel;
		$mvitima = new MVitima;
		$musuario = new MUsuario;

		//----------------------------------------------------------------
		//VALIDACAO DO FORMULARIO
		//----------------------------------------------------------------
		//Validando os campos que nao se repetem e são obrigatorios 
		if (!isset($post['qtdFamilias']) || $post['qtdFamilias'] === '') {
			Validacao::setMsgError("Informe a quantidade de famílias.");
	        header('Location: /criar-apuracao');
	        exit;
		}

		if (!isset($post['tipoApuracao']) || $post['tipoApuracao'] === '') {
			Validacao::setMsgError("Informe o tipo da apuração.");
	        header('Location: /criar-apuracao');
	        exit;
		}

		if (!isset($post['descricaoApuracao']) || $post['descricaoApuracao'] === '') {
			Validacao::setMsgError("Informe a descrição da apuração.");
	        header('Location: /criar-apuracao');
	        exit;
		}

		//Esse loop serve para validar todas vitimas
		for ($i = 1; $i <= 100; $i++) {
			//Verificar se o post existe caso exista porque ele foir clicado para criar
			//Não pode verificar direto se ele não eiste pois se o vitima1 existir e o vitima2 não
			//quando ele cair para verficar o vitima2 ele gerara o erro
			//entao primeiro verifica se ele existe se existir verificar se ele esta vazio
			//caso esteja vazio ai sim gera o erro
			if (!isset($post['nomeVitima'.$i])) {
				//caso não exista continua rodando normalmente o programa
			} else {
				if ($post['nomeVitima'.$i] == "") {
					Validacao::setMsgError("Informe o nome da vitima ".$i." que está vazio.");
			        header('Location: /criar-apuracao');
			        exit;			
				}
			}

			if (!isset($post['cpfVitima'.$i])) {
				//caso não exista continua rodando normalmente o programa
			} else {
				$validaCPF = $validacao->validaCPF($post['cpfVitima'.$i]);

				if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
					Validacao::setMsgError("CPF da Vitima Inválido.");
			        header('Location: /usuarios-cadastrar');
			        exit;
				}

				if ($post['cpfVitima'.$i] == "") {
					Validacao::setMsgError("Informe o CPF da vitima ".$i." que está vazio.");
			        header('Location: /criar-apuracao');
			        exit;			
				}
			}

			if (!isset($post['responsavelVitima'.$i])) {
				//caso não exista continua rodando normalmente o programa
			} else {
				if ($post['responsavelVitima'.$i] == "") {
					Validacao::setMsgError("Informe o nome do responsavel da vitima ".$i." que está vazio.");
			        header('Location: /criar-apuracao');
			        exit;			
				}
			}

			if (!isset($post['cpfResponsavelVitima'.$i])) {
				//caso não exista continua rodando normalmente o programa
			} else {
				$validaCPF = $validacao->validaCPF($post['cpfResponsavelVitima'.$i]);

				if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
					Validacao::setMsgError("CPF do Responsavel da Vitima Inválido.");
			        header('Location: /usuarios-cadastrar');
			        exit;
				}

				if ($post['cpfResponsavelVitima'.$i] == "") {
					Validacao::setMsgError("Informe o CPF do responsavel da vitima ".$i." que está vazio.");
			        header('Location: /criar-apuracao');
			        exit;			
				}
			}
		}


		//----------------------------------------------------------------
		//CADASTRAR APURACAO 
		//----------------------------------------------------------------
		//Passos para criar apuracao
		$mapuracao->cadastrar($post, $_SESSION[Usuario::SESSION]['idUsuario']);

		//Recuperando o id da apuracao criada
		$idApuracao = $mapuracao->ultimoRegistro();

		//Um loop para cadastrar todas as vitimas
		for ($i = 1; $i <= 100; $i++) {

			//Verificar se o post existe
			//Se não vai cadastrar 100 vezes em vazio
			if (!isset($post['nomeVitima'.$i]) || $post['nomeVitima'.$i] == "") {
				//caso não exista continua rodando normalmente o programa
			} else {

				//Mudando o nome da variavel do array 
				//para quando chamar o get e set ñao dar problema 
				//por causa do numero que separa um vitima da outra
				$post['nomeVitima'] = $post['nomeVitima'.$i];
				$post['sexoVitima'] = $post['sexoVitima'.$i];
				$post['cpfVitima'] = $post['cpfVitima'.$i];
				$post['celularVitima'] = $post['celularVitima'.$i];
				$post['responsavelVitima'] = $post['responsavelVitima'.$i];
				$post['cpfResponsavelVitima'] = $post['cpfResponsavelVitima'.$i];
				$post['celularResponsavelVitima'] = $post['celularResponsavelVitima'.$i];
				$post['cepVitima'] = $post['cepVitima'.$i];
				$post['ruaVitima'] = $post['ruaVitima'.$i];
				$post['bairroVitima'] = $post['bairroVitima'.$i];
				$post['numeroVitima'] = $post['numeroVitima'.$i];
				$post['estadoVitima'] = $post['estadoVitima'.$i];
				$post['cidadeVitima'] = $post['cidadeVitima'.$i];
				$post['complementoVitima'] = $post['complementoVitima'.$i];
				$post['qualFamiliaVitima'] = $post['qualFamiliaVitima'.$i];

				//----------------------------------------------------------------
				//CADASTRAR O RESPONSAVEL DA VITIMA 
				//----------------------------------------------------------------
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
					$cpfResponsavelBd = $validacao->replaceCpfBd($post['cpfResponsavelVitima']);

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
					//Levando a hipotese que o responsavel more junto com a vitima
					//Entao o mesmo endereco da vitima corresponde ao responssavel
					$mcontato->cadastrar($post, "responsavelVitima");
					$mendereco->cadastrar($post, "vitima");

					//recuperando o ultimo id de contato e endereco
					$idContato = $mcontato->ultimoRegistro();
					$idEndereco = $mendereco->ultimoRegistro();

					//Cadastrando o responsavel como uma pessoa
					$mpessoa->cadastrar($post, $idContato, $idEndereco, "responsavelVitima");

					//recuperando o ultimo id da pessoa
					$idPessoa = $mpessoa->ultimoRegistro();
				}

				//Cadastrando na tabela responsavelApuracao
				$mresponsavel->cadastrar($idPessoa, "apuracao");

				//recuperando o ultimo id do responsavel da vitima
				$idResponsavel = $mresponsavel->ultimoRegistro();

				//----------------------------------------------------------------
				//CADASTRAR A VITIMA 
				//----------------------------------------------------------------
				//setando a variavel como false
				$usuarioVitimaBloqueou = false;

				//Rodando pelo array de pessoas trazidas do banco de dados
				foreach ($listAllPessoa as $value) {
					//Verificar se o cpf ja existe
					//Retira os pontos e tracos do cpf
					$cpfVitimaBd = $validacao->replaceCpfBd($post['cpfVitima']);

					if ($cpfVitimaBd == $value['cpf']) {
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
						$usuarioVitimaBloqueou = true;

						//Encerra o loop
						break;
					}
				}

				//caso nao tenha acha um cpf igual em cima
				//entao criar uma nova pessoa
				if($usuarioVitimaBloqueou != true) {
					//Cadastrando o endereco e o contato da vitima
					$mcontato->cadastrar($post, "vitima");
					$mendereco->cadastrar($post, "vitima");

					//recuperando o ultimo id de contato e endereco
					$idContato = $mcontato->ultimoRegistro();
					$idEndereco = $mendereco->ultimoRegistro();

					//Cadastrando o responsavel como uma pessoa
					$mpessoa->cadastrar($post, $idContato, $idEndereco, "vitima");

					//recuperando o ultimo id da pessoa
					$idPessoa = $mpessoa->ultimoRegistro();	
				}

				//Cadastrar na tabela vitimaApuracao
				$mvitima->cadastrar($idPessoa, $idResponsavel);

				//Recuperando o ultimo id da vitima
				$idVitima = $mvitima->ultimoRegistro();

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA VitimasCriarApuracao
				//----------------------------------------------------------------
				//Essa tabela serve para ver quais sao as vitimas referente a essa apuracao
				$mapuracao->cadastrarVitimasCriarApuracao($idVitima, $idApuracao);

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA VitimasCriarApuracao
				//----------------------------------------------------------------
				//Essa tabela serve para saber quais vitimas pertencem a mesma familia
				$mapuracao->cadastrarFamiliaApuracao($post, $idApuracao, $idVitima, $idResponsavel);

			}//Fim do else
		}//Fim do for
	}//Fim postCriarApuracao

}

?>