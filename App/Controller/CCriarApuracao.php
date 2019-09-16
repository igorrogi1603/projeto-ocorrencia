<?php

namespace App\Controller;

use \App\Classe\Usuario;
use \App\Model\MApuracao;
use \App\Model\MPessoa;
use \App\Model\MEndereco;
use \App\Model\MContato;
use \App\Model\MResponsavel;
use \App\Model\MVitima;

class CCriarApuracao {

	public static function getCriarApuracao()
	{

	}

	public static function postCriarApuracao($post)
	{
		//Instaciar os Models
		$mapuracao = new MApuracao;
		$mpessoa = new MPessoa;
		$mendereco = new MEndereco;
		$mcontato = new MContato;
		$mresponsavel = new MResponsavel;
		$mvitima = new MVitima;

		//----------------------------------------------------------------
		//VALIDACAO DO FORMULARIO
		//----------------------------------------------------------------
		//Esse for serve para validar todas vitimas
		//for ($i = 1; $i <= 100; $i++) {}

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

				//Cadastrando na tabela responsavelApuracao
				$mresponsavel->cadastrar($idPessoa, "apuracao");

				//recuperando o ultimo id do responsavel da vitima
				$idResponsavel = $mresponsavel->ultimoRegistro();

				//----------------------------------------------------------------
				//CADASTRAR A VITIMA 
				//----------------------------------------------------------------
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