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
use \App\Model\MOcorrencia;
use \App\Model\MAcompanhamento;
use \App\Model\MNotificacao;

class CCriarApuracao {

	public static function getApuracaoEnviada($idApuracao)
	{
		$mapuracao = new MApuracao;
		$validacao = new Validacao;

		$apuracaoCompleta = $mapuracao->listApuracao($idApuracao);

		//Pegando o tamanho do array para usar no for como item de termino do loop
		$tamanhoArray = count($apuracaoCompleta);

		//Validacao dos campos com acentos do banco de dados
		for ($i = 0; $i < $tamanhoArray; $i++) {
			$apuracaoCompleta[$i]['descricao'] = $apuracaoCompleta[$i]['descricao'];
			$apuracaoCompleta[$i]['tipoApuracao'] = $apuracaoCompleta[$i]['tipoApuracao'];
			$apuracaoCompleta[$i]['qualFamilia'] = $apuracaoCompleta[$i]['qualFamilia'];
			$apuracaoCompleta[$i]['nomeVitima'] = $apuracaoCompleta[$i]['nomeVitima'];
			$apuracaoCompleta[$i]['nomeResponsavel'] = $apuracaoCompleta[$i]['nomeResponsavel'];
			$apuracaoCompleta[$i]['ruaVitima'] = $apuracaoCompleta[$i]['ruaVitima'];
			$apuracaoCompleta[$i]['bairroVitima'] = $apuracaoCompleta[$i]['bairroVitima'];
			$apuracaoCompleta[$i]['cidadeVitima'] = $apuracaoCompleta[$i]['cidadeVitima'];
			$apuracaoCompleta[$i]['estadoVitima'] = strtoupper($apuracaoCompleta[$i]['estadoVitima']);
			$apuracaoCompleta[$i]['complementoVitima'] = $apuracaoCompleta[$i]['complementoVitima'];
			$apuracaoCompleta[$i]['ruaResponsavel'] = $apuracaoCompleta[$i]['ruaResponsavel'];
			$apuracaoCompleta[$i]['bairroResponsavel'] = $apuracaoCompleta[$i]['bairroResponsavel'];
			$apuracaoCompleta[$i]['cidadeResponsavel'] = $apuracaoCompleta[$i]['cidadeResponsavel'];
			$apuracaoCompleta[$i]['estadoResponsavel'] = strtoupper($apuracaoCompleta[$i]['estadoResponsavel']);
			$apuracaoCompleta[$i]['complementoResponsavel'] = $apuracaoCompleta[$i]['complementoResponsavel'];
			$apuracaoCompleta[$i]['cpfVitima'] = $validacao->replaceCpfView($apuracaoCompleta[$i]['cpfVitima']);
			$apuracaoCompleta[$i]['celularVitima'] = $validacao->replaceCelularView($apuracaoCompleta[$i]['celularVitima']);
			$apuracaoCompleta[$i]['cpfResponsavel'] = $validacao->replaceCpfView($apuracaoCompleta[$i]['cpfResponsavel']);
			$apuracaoCompleta[$i]['celularResponsavel'] = $validacao->replaceCelularView($apuracaoCompleta[$i]['celularResponsavel']);
			$apuracaoCompleta[$i]['cepVitima'] = $validacao->replaceCepView($apuracaoCompleta[$i]['cepVitima']);
			$apuracaoCompleta[$i]['cepResponsavel'] = $validacao->replaceCepView($apuracaoCompleta[$i]['cepResponsavel']);
			$apuracaoCompleta[$i]['dataRegistro'] = $validacao->replaceDataView($apuracaoCompleta[$i]['dataRegistro']);
		}

		return $apuracaoCompleta;
	}

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
		$macompanhamento = new MAcompanhamento;
		$mnotificacao = new MNotificacao;
		$mocorrencia = new MOcorrencia;

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
				//Vai validar se o cpf da vitima nao estiver fazio
				if ($post['cpfVitima'.$i] != "" && $post['cpfVitima'.$i] != null) {
					$validaCPF = $validacao->validaCPF($post['cpfVitima'.$i]);

					if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
						Validacao::setMsgError("CPF da Vitima ".$i." Inválido.");
				        header('Location: /criar-apuracao');
				        exit;
					}
				}
			}

			if (!isset($post['dataNascVitima'.$i])) {
				//caso não exista continua rodando normalmente o programa
			} else {
				if ($post['dataNascVitima'.$i] == "") {
					Validacao::setMsgError("Informe a data de nascimento da vitima ".$i." que está vazio.");
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
					Validacao::setMsgError("CPF do Responsavel da Vitima ".$i." Inválido.");
			        header('Location: /criar-apuracao');
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
				//para quando chamar o get e set nao dar problema 
				//por causa do numero que separa um vitima da outra
				$post['nomeVitima'] = $post['nomeVitima'.$i];
				$post['sexoVitima'] = $post['sexoVitima'.$i];
				$post['cpfVitima'] = $post['cpfVitima'.$i];
				$post['dataNascVitima'] = $post['dataNascVitima'.$i];
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
								//e um usuario, entao bloquear o acesso dele a ocorrencia 
								$mocorrencia->bloquearOcorrenciaUsuario($idApuracao[0]["MAX(idCriarApuracao)"], $valueUser['idUsuario']);
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
					$mendereco->cadastrar($post, "vitimaCiarApuracao");

					//recuperando o ultimo id de contato e endereco
					$idContato = $mcontato->ultimoRegistro();
					$idEndereco = $mendereco->ultimoRegistro();

					//Cadastrando o responsavel como uma pessoa
					$mpessoa->cadastrar($post, $idContato, $idEndereco, "responsavelVitima");

					//recuperando o ultimo id da pessoa
					$idPessoa = $mpessoa->ultimoRegistro();
				}

				//Cadastrando na tabela responsavelApuracao
				$mresponsavel->cadastrar($idPessoa, "apuracao", "");

				//recuperando o ultimo id do responsavel da vitima
				$idResponsavel = $mresponsavel->ultimoRegistro();

				//----------------------------------------------------------------
				//CADASTRAR A VITIMA 
				//----------------------------------------------------------------
				//setando a variavel como false
				$usuarioVitimaBloqueou = false;

				//Rodando pelo array de pessoas trazidas do banco de dados
				foreach ($listAllPessoa as $value) {
					//Se o cpf da vitima existir entao verifica pelo cpf 
					//caso nao exista o cpf entao verificar pelo nome e data de nascimento
					if (isset($post['cpfVitima']) && $post['cpfVitima'] != "" && $post['cpfVitima'] != null) {
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
									$mocorrencia->bloquearOcorrenciaUsuario($idApuracao[0]["MAX(idCriarApuracao)"], $valueUser['idUsuario']);
								}
							}

							//caso ele ache um cpf igual seta como true a variavel
							//e no if de baixo nao deixa rodar
							$usuarioVitimaBloqueou = true;

							//Encerra o loop
							break;
						}
					} else {
						//Transforma a data de nascimento igual ao do banco de dados para comparar igual
						$dataNascVitimaBd = $validacao->replaceDataBd($post['dataNascVitima']);

						if ($dataNascVitimaBd == $value['dataNasc'] && strtolower($post['nomeVitima']) == strtolower($value['nome'])) {
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
									$mocorrencia->bloquearOcorrenciaUsuario($idApuracao[0]["MAX(idCriarApuracao)"], $valueUser['idUsuario']);
								}
							}

							//caso ele ache um cpf igual seta como true a variavel
							//e no if de baixo nao deixa rodar
							$usuarioVitimaBloqueou = true;

							//Encerra o loop
							break;
						}

					} //Fim if se cpf existe
				} //fim foreach

				//caso nao tenha acha um cpf igual em cima
				//Ou nome da vitima e a data de nascimento nao tenha achado
				//entao criar uma nova pessoa
				if($usuarioVitimaBloqueou != true) {
					//Cadastrando o endereco e o contato da vitima
					$mcontato->cadastrar($post, "vitimaCiarApuracao");
					$mendereco->cadastrar($post, "vitimaCiarApuracao");

					//recuperando o ultimo id de contato e endereco
					$idContato = $mcontato->ultimoRegistro();
					$idEndereco = $mendereco->ultimoRegistro();

					//Cadastrando o responsavel como uma pessoa
					$mpessoa->cadastrar($post, $idContato, $idEndereco, "vitima");

					//recuperando o ultimo id da pessoa
					$idPessoa = $mpessoa->ultimoRegistro();	
				}

				//Cadastrar na tabela vitimaApuracao
				$mvitima->cadastrar($idPessoa);

				//Recuperando o ultimo id da vitima
				$idVitima = $mvitima->ultimoRegistro();

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA ResponsavelVitimas
				//----------------------------------------------------------------				
				//Essa tabela monitora quem sao os responsaveis de cada vitima
				$mresponsavel->cadastrarResponsavelVitimas($idResponsavel, $idVitima, "apuracao");

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA VitimasCriarApuracao
				//----------------------------------------------------------------
				//Essa tabela serve para ver quais sao as vitimas referente a essa apuracao
				$mapuracao->cadastrarVitimasCriarApuracao($idVitima, $idApuracao);

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA FamiliaApuracao
				//----------------------------------------------------------------
				//Essa tabela serve para saber quais vitimas pertencem a mesma familia
				$mapuracao->cadastrarFamiliaApuracao($post, $idApuracao, $idVitima, $idResponsavel);

				//----------------------------------------------------------------
				//CADASTRAR NA TABELA AcompanhamentoVitima O ENDERECO
				//----------------------------------------------------------------
				$macompanhamento->cadastrar($post, $idVitima[0]["MAX(idVitimasApuracao)"]);

			}//Fim do else
		}//Fim do for

		//Notificacao
		$mnotificacao->cadastrar("Nova Apuração", "/apuracao-detalhe/".$idApuracao[0]["MAX(idCriarApuracao)"]);

		return $idApuracao;

	}//Fim postCriarApuracao

}

?>