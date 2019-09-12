<?php

namespace App\Controller;

use \App\Model\MUsuario;
use \App\Model\MPessoa;
use \App\Model\MEndereco;
use \App\Model\MContato;
use \App\Classe\Pessoa;
use \App\Classe\Validacao;

class CDetalheUsuario {

	//Validar os capos retornados do banco de dados
	public static function getDetalheUsuario($idUsuario)
	{
		$musuario = new MUsuario;
		$pessoa = new Pessoa;
		$validacao = new Validacao;

		$dados = $musuario->detalheUsuario($idUsuario);

		$dados[0]['nome'] = utf8_encode($dados[0]['nome']);
		$dados[0]['rua'] = utf8_encode($dados[0]['rua']);
		$dados[0]['bairro'] = utf8_encode($dados[0]['bairro']);
		$dados[0]['cidade'] = utf8_encode($dados[0]['cidade']);
		$dados[0]['setor'] = utf8_encode($dados[0]['setor']);
		$dados[0]['funcao'] = utf8_encode($dados[0]['funcao']);
		$dados[0]['qtdAnos'] = $pessoa->qtdAnos($dados[0]['dataNasc']);
		$dados[0]['dataNasc'] = $validacao->replaceDataView($dados[0]['dataNasc']);
		$dados[0]['cpf'] = $validacao->replaceCpfView($dados[0]['cpf']);
		$dados[0]['rg'] = $validacao->replaceRgView($dados[0]['rg']);
		$dados[0]['celular'] = $validacao->replaceCelularView($dados[0]['celular']);
		$dados[0]['fixo'] = $validacao->replaceTelefoneFixoView($dados[0]['fixo']);
		$dados[0]['cep'] = $validacao->replaceCepView($dados[0]['cep']);
		$dados[0]['estado'] = strtoupper($dados[0]['estado']);

		if ($dados[0]['sexo'] == 'm') {
			$dados[0]['sexo'] = "Masculino";
		} else if ($dados[0]['sexo'] == 'f') {
			$dados[0]['sexo'] = "Feminino";
		}
		
		return $dados[0];
	}

	//bloquear o usuario para nao ter acesso ao sistema
	public static function getBloquear($idUsuario)
	{
		$musuario = new MUsuario;

		$musuario->bloquearUsuario($idUsuario);
	}

	//desbloquear o usuario para ter acesso ao sistema
	public static function getDesbloquear($idUsuario)
	{
		$musuario = new MUsuario;

		$musuario->desbloquearUsuario($idUsuario);
	}

	//desbloquear o usuario para ter acesso ao sistema
	public static function getExcluir($idUsuario)
	{
		$musuario = new MUsuario;
		$mpessoa = new MPessoa;
		$mendereco = new MEndereco;
		$mcontato = new MContato;

		$usuario = $musuario->usuarioEspecifico($idUsuario);
		$pessoa = $mpessoa->pessoaEspecifica($usuario[0]['idPessoa']);

		$idPessoa = $usuario[0]['idPessoa'];
		$idEndereco = $pessoa[0]['idEndereco'];
		$idContato = $pessoa[0]['idContato'];

		$musuario->excluirUsuario($idUsuario);
		$mpessoa->excluirPessoa($idPessoa);
		$mendereco->excluirEndereco($idEndereco);
		$mcontato->excluirContato($idContato);
	}

	public static function getEditar($idUsuario)
	{
		$musuario = new MUsuario;
		$validacao = new Validacao;

		$dados = $musuario->detalheUsuario($idUsuario);

		$dados[0]['nome'] = utf8_encode($dados[0]['nome']);
		$dados[0]['rua'] = utf8_encode($dados[0]['rua']);
		$dados[0]['bairro'] = utf8_encode($dados[0]['bairro']);
		$dados[0]['cidade'] = utf8_encode($dados[0]['cidade']);
		$dados[0]['setor'] = utf8_encode($dados[0]['setor']);
		$dados[0]['funcao'] = utf8_encode($dados[0]['funcao']);
		$dados[0]['dataNasc'] = $validacao->replaceDataView($dados[0]['dataNasc']);
		$dados[0]['digitoRg'] = $validacao->replaceDigitoRg($dados[0]['rg']);
		$dados[0]['rg'] = $validacao->replaceSemDigitoRg($dados[0]['rg']);
		
		return $dados[0];
	}

	public static function postAlterarSenha($post, $idUsuario)
	{
		$musuario = new MUsuario;

		$musuario->alterarSenha($post, $idUsuario);
	}

	public static function postEditar($post, $idUsuario)
	{
		//instancia objeto classe
		$validacao = new Validacao;

		//instancia do objeto model
		$mcontato = new MContato;
		$mendereco = new MEndereco;
		$mpessoa = new MPessoa;
		$musuario = new MUsuario;

		//Recuperando os IDs
		$usuarioEspecifico = $musuario->usuarioEspecifico($idUsuario);
		$pessoaEspecifica = $mpessoa->pessoaEspecifica($usuarioEspecifico[0]['idPessoa']);

		$idPessoa = $usuarioEspecifico[0]['idPessoa'];		
		$idEndereco = $pessoaEspecifica[0]['idEndereco'];
		$idContato = $pessoaEspecifica[0]['idContato'];

		//Validacoes de Campo
		//--------------------------------------------------------------------------------------
		$post['nomeUsuario'] = $validacao->validarString($post['nomeUsuario'], 1);
		$validaCPF = $validacao->validaCPF($post['cpfUsuario']);
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
	        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
	        exit;
		}

		if (!isset($post['funcaoUsuario']) || $post['funcaoUsuario'] === '') {
			Validacao::setMsgError("Informe a Função.");
	        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
	        exit;
		}

		if (!isset($post['usernameUsuario']) || $post['usernameUsuario'] === '') {
			Validacao::setMsgError("Informe o usuário.");
	        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
	        exit;
		}

		//Nao pode cadastrar usuarios com cpf iguais
		//Pelo cpf da para saber se tem duas pessoas com mais de uma conta
		$cpfIgual = $mpessoa->cpfIgualUpdate($idPessoa);

		foreach ($cpfIgual as $cpf) {
			if ($validacao->replaceCpfBd($post['cpfUsuario']) == $cpf['cpf']) {
				Validacao::setMsgError("Este cpf já está cadastrado.");
		        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
		        exit;
			}
		}

		//Nao pode cadastrar usuarios com usernames iguais
		$userIgual = $musuario->userIgualUpdate($idUsuario);

		foreach ($userIgual as $user) {
			if ($post['usernameUsuario'] == $user['user']) {
				Validacao::setMsgError("Este username de login já está cadastrado.");
		        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
		        exit;
			}
		}

		//----------------------------------------------------------------------------------------
		//atualizar
		$musuario->update($post, $idUsuario);
		$mpessoa->update($post, $idPessoa);
		$mendereco->update($post, $idEndereco);
		$mcontato->update($post, $idContato);
	}

}

?>