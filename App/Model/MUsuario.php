<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Usuario;
use \App\Classe\Validacao;

class MUsuario {

	const SESSION = "User";

	//Cadastrar os Usuarios no banco de dados
	public function cadastrar($post, $id, $complemento)
	{
		$sql = new Conexao;

		$usuario = new Usuario;
		$validacao = new Validacao;

		$usuario->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					INSERT INTO tb_usuario (idPessoa, idInstituicao, nivelAcesso, user, senha, funcao, setor, isBloqueado) 
					VALUES(:idPessoa, :idInstituicao, :nivelAcesso, :user, :senha, :funcao, :setor, :isBloqueado)
				", [
					":idPessoa" => (int)$id[0]["MAX(idPessoa)"],
					":idInstituicao" => null,
					":nivelAcesso" => $usuario->getnivelUsuario(),
					":user" => Validacao::tirarAcentos($usuario->getusernameUsuario()),
					":senha" => Usuario::getPasswordHash($usuario->getsenhaUsuario()),
					":funcao" => utf8_decode($usuario->getfuncaoUsuario()),
					":setor" => utf8_decode($usuario->getsetorUsuario()),
					":isBloqueado" => 0
				]);	
				break;

			case 'instituicao':
				$sql->query("
					INSERT INTO tb_usuario (idPessoa, idInstituicao, nivelAcesso, user, senha, funcao, setor, isBloqueado) 
					VALUES(:idPessoa, :idInstituicao, :nivelAcesso, :user, :senha, :funcao, :setor, :isBloqueado)
				", [
					":idPessoa" => null,
					":idInstituicao" => (int)$id[0]["MAX(idInstituicao)"],
					":nivelAcesso" => $usuario->getnivelUsuario(),
					":user" => Validacao::tirarAcentos($usuario->getusernameUsuario()),
					":senha" => Usuario::getPasswordHash($usuario->getsenhaUsuario()),
					":funcao" => "",
					":setor" => "",
					":isBloqueado" => 0
				]);		
				break;
		}

	}

	public function update($post, $idUsuario)
	{
		$sql = new Conexao;

		$usuario = new Usuario;
		$validacao = new Validacao;		

		$usuario->setData($post);
		
		$sql->query("
			UPDATE tb_usuario 
			SET nivelAcesso = :nivelAcesso, user = :user, funcao = :funcao, setor = :setor
			WHERE idUsuario = :idUsuario
		", [
			":nivelAcesso" => $usuario->getnivelUsuario(),
			":user" => Validacao::tirarAcentos($usuario->getusernameUsuario()),
			":funcao" => utf8_decode($usuario->getfuncaoUsuario()),
			":setor" => utf8_decode($usuario->getsetorUsuario()),
			":idUsuario" => $idUsuario
		]);
	}

	//Alterar Senha
	public function alterarSenha($post, $idUsuario)
	{
		$sql = new Conexao;

		$usuario = new Usuario;	

		$usuario->setData($post);

		$sql->query("
			UPDATE tb_usuario 
			SET senha = :senha
			WHERE idUsuario = :idUsuario
		", [
			":senha" => Usuario::getPasswordHash($usuario->getsenhaUsuario()),
			":idUsuario" => $idUsuario
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_usuario");	
	}

	//Pega ultimo registro da tabela para usar como foreign key
	public function ultimoRegistro()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idUsuario) FROM tb_usuario");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Serve para localizar um usuario especifico para excluir por exemplo
	public function usuarioEspecifico($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_usuario WHERE idUsuario = :idUsuario", [
			":idUsuario" => $idUsuario
		]);
	}

	//Evitar de duplicar usuarios no banco de dados
	public function userIgual()
	{
		$sql = new Conexao;

		return $sql->select("SELECT user FROM tb_usuario");		
	}

	//Evitar de duplicar usuarios no banco quando for atualizar um usuario
	public function userIgualUpdate($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("SELECT user FROM tb_usuario WHERE idUsuario != :idUsuario", [
			":idUsuario" => $idUsuario
		]);
	}

	//Logar no sistema
	public static function login($login, $password)
	{
		$sql = new Conexao;

		$pessoa = $sql->select("
			SELECT * FROM tb_usuario a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa
			WHERE user = :user
		", array(
			":user"=>$login
		));

		$instituicao = $sql->select("
			SELECT * FROM tb_usuario a
			INNER JOIN tb_instituicao b ON a.idInstituicao = b.idInstituicao
			WHERE user = :user
		", array(
			":user"=>$login
		));		

		if (count($pessoa) === 0 && count($instituicao) === 0)
		{
			return false;
		}

		if (isset($pessoa) && $pessoa != null && $pessoa != "" && count($pessoa) != 0) {
			$data = $pessoa[0];
		}

		if (isset($instituicao) && $instituicao != null && $instituicao != "" && count($instituicao) != 0) {
			$data = $instituicao[0];
		}

		if (password_verify($password, $data["senha"]) === true)
		{
			$usuario = new Usuario();

			$usuario->setData($data);

			$_SESSION[Usuario::SESSION] = $usuario->getValues();

			return $usuario;

		} else {
			return false;
		}
	}

	//Lista os dados do usuario para listar na tabela para gerencia-los
	public function listaUsuario()
	{
		$sql = new Conexao;

		return $sql->select(
			"SELECT a.idUsuario, a.funcao, a.setor, a.isBloqueado, a.nivelAcesso, b.nome, b.cpf
			FROM tb_usuario a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa"
		);
	}

	public function listaUsuarioInstituicao()
	{
		$sql = new Conexao;

		return $sql->select(
			"SELECT a.idUsuario, a.funcao, a.setor, a.isBloqueado, a.nivelAcesso, b.nome, b.cnpj
			FROM tb_usuario a
			INNER JOIN tb_instituicao b ON a.idInstituicao = b.idInstituicao"
		);
	}

	//Detalhe do usuario para gerencia-los
	public function detalheUsuario($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idUsuario, a.nivelAcesso, a.user, a.funcao, a.setor, a.isBloqueado, a.dataRegistro, 
			b.idPessoa, b.nome, b.dataNasc, b.cpf, b.rg, b.sexo,
			c.idContato, c.celular, c.fixo, c.email, 
			d.idEndereco, d.cep, d.rua, d.numero, d.bairro, d.cidade, d.estado, d.complemento
			FROM tb_usuario a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa
			INNER JOIN tb_contato c ON b.idContato = c.idContato
			INNER JOIN tb_endereco d ON b.idEndereco = d.idEndereco
			WHERE a.idUsuario = :idUsuario;
		", [
			":idUsuario" => $idUsuario
		]);
	}

	public function detalheUsuarioInstituicao($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idUsuario, a.nivelAcesso, a.user, a.funcao, a.setor, a.isBloqueado, a.dataRegistro, 
			b.idInstituicao, b.nome, b.cnpj,
			c.idContato, c.celular, c.fixo, c.email, 
			d.idEndereco, d.cep, d.rua, d.numero, d.bairro, d.cidade, d.estado, d.complemento
			FROM tb_usuario a
			INNER JOIN tb_instituicao b ON a.idInstituicao = b.idInstituicao
			INNER JOIN tb_contato c ON b.idContato = c.idContato
			INNER JOIN tb_endereco d ON b.idEndereco = d.idEndereco
			WHERE a.idUsuario = :idUsuario;
		", [
			":idUsuario" => $idUsuario
		]);
	}

	public function bloquearUsuario($idUsuario)
	{
		$sql = new Conexao;

		$sql->select("UPDATE tb_usuario SET isBloqueado = 1 WHERE idUsuario = :idUsuario", [
			"idUsuario" => $idUsuario
		]);
	}

	public function desbloquearUsuario($idUsuario)
	{
		$sql = new Conexao;

		$sql->query("UPDATE tb_usuario SET isBloqueado = 0 WHERE idUsuario = :idUsuario", [
			"idUsuario" => $idUsuario
		]);
	}

	public function excluirUsuario($idUsuario)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_usuario WHERE idUsuario = :idUsuario", [
			"idUsuario" => $idUsuario
		]);
	}

}

?>