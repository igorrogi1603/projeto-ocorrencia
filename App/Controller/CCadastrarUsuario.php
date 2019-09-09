<?php

namespace App\Controller;

use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MPessoa;
use \App\Model\MUsuario;
use \App\Classe\Pessoa;
use \App\Classe\Endereco;
use \App\Classe\Usuario;
use \App\Classe\Validacao;

class CCadastrarUsuario {

	public static function postCadastrarUsuario($post)
	{	
		//instancia objeto classe
		$pessoa = new Pessoa;
		$endereco = new Endereco;
		$usuario = new Usuario;
		$validacao = new Validacao;

		//instancia do objeto model
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$mpessoa = new MPessoa;
		$musuario = new MUsuario;

		//Validacao de campos
		//----------------------------------------------------------------------------------------
		$post['nomeUsuario'] = $validacao->validarString($post['nomeUsuario'], 1);
		$validaCPF = $pessoa->validaCPF($post['cpfUsuario']);
		$post['funcaoUsuario'] = $validacao->validarString($post['funcaoUsuario'], 1);
		$post['cepUsuario'] = $validacao->validarString($post['cepUsuario'], 3);
		$post['ruaUsuario'] = $validacao->validarString($post['ruaUsuario'], 2);
		$post['bairroUsuario'] = $validacao->validarString($post['bairroUsuario'], 2);
		$post['numeroUsuario'] = $validacao->validarString($post['numeroUsuario'], 3);
		$post['cidadeUsuario'] = $validacao->validarString($post['cidadeUsuario'], 1);
		$post['complementoUsuario'] = $validacao->validarString($post['complementoUsuario'], 2);
		$post['usernameUsuario'] = $validacao->validarString($post['usernameUsuario'], 4);

		if ($validaCPF === false || !isset($validaCPF) || $validaCPF === '') {
			Validacao::setMsgError("CPF Inválido.");
	        header('Location: /usuarios-cadastrar');
	        exit;
		}

		if (!isset($post['funcaoUsuario']) || $post['funcaoUsuario'] === '') {
			Validacao::setMsgError("Informe a Função.");
	        header('Location: /usuarios-cadastrar');
	        exit;
		}

		if (!isset($post['usernameUsuario']) || $post['usernameUsuario'] === '') {
			Validacao::setMsgError("Informe o usuário.");
	        header('Location: /usuarios-cadastrar');
	        exit;
		}

		if (!isset($post['senhaUsuario']) || $post['senhaUsuario'] === '') {
			Validacao::setMsgError("Informe a senha.");
	        header('Location: /usuarios-cadastrar');
	        exit;
		}

		//----------------------------------------------------------------------------------------
		//passando os campos para cadastrar
		$mcontato->cadastrar($post);
		$mendereco->cadastrar($post);

		//recuperando o ultimo id de contato e endereco
		$idContato = $mcontato->ultimoRegistro();
		$idEndereco = $mendereco->ultimoRegistro();

		//cadastrando um usuario
		$mpessoa->cadastrar($post, $idContato, $idEndereco);

		//recuperando o ultimo id de pessoa para o usuario
		$idPessoa = $mpessoa->ultimoRegistro();

		//cadastrando o usuario
		$musuario->cadastrar($post, $idPessoa);
	}

}
?>