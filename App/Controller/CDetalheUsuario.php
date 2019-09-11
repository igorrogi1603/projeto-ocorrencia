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

}

?>