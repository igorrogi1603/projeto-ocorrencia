<?php

namespace App\Controller;

use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MPessoa;
use \App\Model\MUsuario;
use \App\Classe\Pessoa;
use \App\Classe\Endereco;
use \App\Classe\Usuario;

class CCadastrarUsuario {

	public static function postCadastrarUsuario($post)
	{	
		//instancia objeto classe
		$pessoa = new Pessoa;
		$endereco = new Endereco;
		$usuario = new Usuario;

		//instancia do objeto model
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$mpessoa = new MPessoa;
		$musuario = new MUsuario;

		//Validacao de campos
		$post['nomeUsuario'] = $pessoa->validarLetraAcento($post['nomeUsuario']);
		$validaCPF = $pessoa->validaCPF($post['cpfUsuario']);
		
		if ($validaCPF === false) {
			//mensagem de erro retornando para a pagina anterior
		}

		$post['funcaoUsuario'] = $pessoa->validarLetraAcento($post['funcaoUsuario']);
		$post['ruaUsuario'] = $endereco->validarLetraAcentoNumero($post['ruaUsuario']);
		$post['bairroUsuario'] = $endereco->validarLetraAcentoNumero($post['bairroUsuario']);
		$post['numeroUsuario'] = $endereco->validarNumero($post['numeroUsuario']);
		$post['cidadeUsuario'] = $endereco->validarLetraAcento($post['cidadeUsuario']);
		$post['complementoUsuario'] = $endereco->validarLetraAcentoNumero($post['complementoUsuario']);
		$post['usernameUsuario'] = $usuario->validarLetraNumero($post['usernameUsuario']);

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