<?php

namespace App\Controller;

use \App\Model\MUsuario;
use \App\Model\MPessoa;
use \App\Model\MEndereco;
use \App\Model\MContato;
use \App\Model\MInstituicao;
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
		$dadosInstituicao = $musuario->detalheUsuarioInstituicao($idUsuario);

		if (count($dados) != 0 || count($dados) != "" || count($dados) != null) {
			$dados[0]['nome'] = $dados[0]['nome'];
			$dados[0]['rua'] = $dados[0]['rua'];
			$dados[0]['bairro'] = $dados[0]['bairro'];
			$dados[0]['cidade'] = $dados[0]['cidade'];
			$dados[0]['setor'] = $dados[0]['setor'];
			$dados[0]['funcao'] = $dados[0]['funcao'];
			$dados[0]['qtdAnos'] = $pessoa->qtdAnos($dados[0]['dataNasc']);
			$dados[0]['dataNasc'] = $validacao->replaceDataView($dados[0]['dataNasc']);
			$dados[0]['cpf'] = $validacao->replaceCpfView($dados[0]['cpf']);
			$dados[0]['rg'] = $validacao->replaceRgView($dados[0]['rg']);
			$dados[0]['digitoRg'] = $validacao->replaceDigitoRg($dados[0]['rg']);
			$dados[0]['celular'] = $validacao->replaceCelularView($dados[0]['celular']);
			$dados[0]['fixo'] = $validacao->replaceTelefoneFixoView($dados[0]['fixo']);
			$dados[0]['cep'] = $validacao->replaceCepView($dados[0]['cep']);
			$dados[0]['estado'] = strtoupper($dados[0]['estado']);
			$dados[0]['status'] = "";
			$dados[0]['isPessoa'] = '1';

			if ($dados[0]['sexo'] == 'm') {
				$dados[0]['sexo'] = "Masculino";
			} else if ($dados[0]['sexo'] == 'f') {
				$dados[0]['sexo'] = "Feminino";
			}

			return $dados[0];
		}

		if (count($dadosInstituicao) != 0 || count($dadosInstituicao) != "" || count($dadosInstituicao) != null) {
			$dadosInstituicao[0]['nome'] = $dadosInstituicao[0]['nome'];
			$dadosInstituicao[0]['subnome'] = $dadosInstituicao[0]['subnome'];
			$dadosInstituicao[0]['rua'] = $dadosInstituicao[0]['rua'];
			$dadosInstituicao[0]['bairro'] = $dadosInstituicao[0]['bairro'];
			$dadosInstituicao[0]['cidade'] = $dadosInstituicao[0]['cidade'];
			$dadosInstituicao[0]['cnpj'] = $validacao->replaceCnpjView($dadosInstituicao[0]['cnpj']);
			$dadosInstituicao[0]['celular'] = $validacao->replaceCelularView($dadosInstituicao[0]['celular']);
			$dadosInstituicao[0]['fixo'] = $validacao->replaceTelefoneFixoView($dadosInstituicao[0]['fixo']);
			$dadosInstituicao[0]['cep'] = $validacao->replaceCepView($dadosInstituicao[0]['cep']);
			$dadosInstituicao[0]['estado'] = strtoupper($dadosInstituicao[0]['estado']);
			$dadosInstituicao[0]['isPessoa'] = '0';

			return $dadosInstituicao[0];
		}
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

	public static function getEditar($idUsuario)
	{
		return CDetalheUsuario::getDetalheUsuario($idUsuario);
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
		$minstituicao = new MInstituicao;

		//Recuperando os IDs
		$usuarioEspecifico = $musuario->usuarioEspecifico($idUsuario);

		$idInstituicao = $usuarioEspecifico[0]['idInstituicao'];
		$idPessoa = $usuarioEspecifico[0]['idPessoa'];

		if ($idPessoa != null || $idPessoa != "") {
			$pessoaEspecifica = $mpessoa->pessoaEspecifica($usuarioEspecifico[0]['idPessoa']);

			$idEndereco = $pessoaEspecifica[0]['idEndereco'];
			$idContato = $pessoaEspecifica[0]['idContato'];
		}

		if ($idInstituicao != null || $idInstituicao != "") {
			$instituicaoEspecifica = $minstituicao->InstituicaoEspecifica($usuarioEspecifico[0]['idInstituicao']);

			$idEndereco = $instituicaoEspecifica[0]['idEndereco'];
			$idContato = $instituicaoEspecifica[0]['idContato'];
		}

		//Validacoes de Campo
		//-------------------------------------------------------------------------------------

		//validando pessoa
		if ($idPessoa != null || $idPessoa != "") {
			$validaCPF = $validacao->validaCPF($post['cpfUsuario']);
			$post['funcaoUsuario'] = $validacao->validarString($post['funcaoUsuario'], 1);

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
		}

		//validando instituicao
		if ($idInstituicao != null || $idInstituicao != "") {
			$validaCNPJ = $validacao->validaCnpj($post['cnpjInstituicao']);

			if ($validaCNPJ === false || !isset($validaCNPJ) || $validaCNPJ === '') {
				Validacao::setMsgError("CNPJ Inválido.");
		        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
		        exit;
			}

			//HiddenStatusAgressor
			//1 = Instituicao Publica
			//2 = Pessoa Juridica

			//Pessoa juridica nao pode repetir o cnpj
			if (isset($post['hiddenStatusUsuario']) && $post['hiddenStatusUsuario'] == 2) {
				//Nao pode cadastrar usuarios com cpf iguais
				//Pelo cpf da para saber se tem duas pessoas com mais de uma conta
				$cnpjIgual = $minstituicao->cnpjIgualUpdate($idInstituicao);

				foreach ($cnpjIgual as $cnpj) {
					if ($validacao->replaceCnpjBd($post['cnpjInstituicao']) == $cnpj['cnpj']) {
						Validacao::setMsgError("Este cnpj já está cadastrado.");
				        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
				        exit;
					}
				}
			}

			//Instituicao Publica usa o mesmo cnpj mas com o subnome diferente
			if (isset($post['hiddenStatusUsuario']) && $post['hiddenStatusUsuario'] == 1) {
				if (!isset($post['subnomeUsuario']) || $post['subnomeUsuario'] == '') {
					Validacao::setMsgError("Informe o subnome da Instituição Pública.");
			        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
			        exit;
				}

				$post['subnomeUsuario'] = $validacao->validarString($post['subnomeUsuario'], 1);
			}
		}

		$post['nomeUsuario'] = $validacao->validarString($post['nomeUsuario'], 1);
		$post['cepUsuario'] = $validacao->validarString($post['cepUsuario'], 3);
		$post['ruaUsuario'] = $validacao->validarString($post['ruaUsuario'], 2);
		$post['bairroUsuario'] = $validacao->validarString($post['bairroUsuario'], 2);
		$post['numeroUsuario'] = $validacao->validarString($post['numeroUsuario'], 3);
		$post['cidadeUsuario'] = $validacao->validarString($post['cidadeUsuario'], 1);
		$post['complementoUsuario'] = $validacao->validarString($post['complementoUsuario'], 2);
		$post['usernameUsuario'] = $validacao->validarString($post['usernameUsuario'], 4);

		if (!isset($post['usernameUsuario']) || $post['usernameUsuario'] === '') {
			Validacao::setMsgError("Informe o usuário.");
	        header('Location: /usuarios-detalhe/editar/'.$idUsuario);
	        exit;
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

		//Editar Pessoa
		if ($idPessoa != null || $idPessoa != "") {
			$musuario->update($post, $idUsuario);
			$mpessoa->update($post, $idPessoa, 'usuario');
			$mendereco->update($post, $idEndereco, 'usuario');
			$mcontato->update($post, $idContato, 'usuario');
		}

		//Editar Instituicao
		if ($idInstituicao != null || $idInstituicao != "") {
			$musuario->update($post, $idUsuario);
			$minstituicao->update($post, $idInstituicao, 'usuario');
			$mendereco->update($post, $idEndereco, 'usuario');
			$mcontato->update($post, $idContato, 'usuario');
		}

	}

}

?>