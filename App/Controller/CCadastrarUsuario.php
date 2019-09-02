<?php

namespace App\Controller;

use \App\Model\MContato;
use \App\Model\MEndereco;
use \App\Model\MPessoa;
use \App\Model\MUsuario;

class CCadastrarUsuario {

	public static function postCadastrarUsuario($post)
	{
		//instancia do objeto
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$mpessoa = new MPessoa;
		$musuario = new MUsuario;

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