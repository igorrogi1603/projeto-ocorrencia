<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Pessoa;
use \App\Classe\Validacao;

class MPessoa {

	public function cadastrar($post, $idContato, $idEndereco, $complemento)
	{
		$sql = new Conexao;

		$pessoa = new Pessoa;
		$validacao = new Validacao;

		$pessoa->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					INSERT INTO tb_pessoa (idEndereco, idContato, nome, dataNasc, cpf, rg, sexo) 
					VALUES(:idEndereco, :idContato, :nome, :dataNasc, :cpf, :rg, :sexo)
				", [
					":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
					":idContato" => (int)$idContato[0]["MAX(idContato)"],
					":nome" => utf8_decode($validacao->validarString($pessoa->getnomeUsuario(), 1)),
					":dataNasc" => $validacao->replaceDataBd($pessoa->getdataNascUsuario()),
					":cpf" => $validacao->replaceCpfBd($pessoa->getcpfUsuario()),
					":rg" => $validacao->replaceRgBd($pessoa->getrgUsuario(), $pessoa->getrgDigitoUsuario()),
					":sexo" => $pessoa->getsexoUsuario()
				]);
				break;

			case 'vitima':
				$sql->query("
					INSERT INTO tb_pessoa (idEndereco, idContato, nome, cpf, sexo) 
					VALUES(:idEndereco, :idContato, :nome, :cpf, :sexo)
				", [
					":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
					":idContato" => (int)$idContato[0]["MAX(idContato)"],
					":nome" => utf8_decode($validacao->validarString($pessoa->getnomeVitima(), 1)),
					":cpf" => $validacao->replaceCpfBd($pessoa->getcpfVitima()),
					":sexo" => $pessoa->getsexoVitima()
				]);
				break;
			
			case 'responsavelVitima':
				$sql->query("
					INSERT INTO tb_pessoa (idEndereco, idContato, nome, cpf) 
					VALUES(:idEndereco, :idContato, :nome, :cpf)
				", [
					":idEndereco" => (int)$idEndereco[0]["MAX(idEndereco)"],
					":idContato" => (int)$idContato[0]["MAX(idContato)"],
					":nome" => utf8_decode($validacao->validarString($pessoa->getresponsavelVitima(), 1)),
					":cpf" => $validacao->replaceCpfBd($pessoa->getcpfResponsavelVitima()),
				]);
				break;

			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	//-------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------

	public function update($post, $idPessoa)
	{
		$sql = new Conexao;

		$pessoa = new Pessoa;
		$validacao = new Validacao;		

		$pessoa->setData($post);

		$sql->query("
			UPDATE tb_pessoa 
			SET nome = :nome, dataNasc = :dataNasc, cpf = :cpf, rg = :rg, sexo = :sexo
			WHERE idPessoa = :idPessoa
		", [
			":nome" => utf8_decode($validacao->validarString($pessoa->getnomeUsuario(), 1)),
			":dataNasc" => $validacao->replaceDataBd($pessoa->getdataNascUsuario()),
			":cpf" => $validacao->replaceCpfBd($pessoa->getcpfUsuario()),
			":rg" => $validacao->replaceRgBd($pessoa->getrgUsuario(), $pessoa->getrgDigitoUsuario()),
			":sexo" => $pessoa->getsexoUsuario(),
			"idPessoa" => $idPessoa
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_pessoa");	
	}

	public function ultimoRegistro()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idPessoa) FROM tb_pessoa");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Serve para localizar um usuario especifico para excluir por exemplo
	public function pessoaEspecifica($idPessoa)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_pessoa WHERE idPessoa = :idPessoa", [
			":idPessoa" => $idPessoa
		]);
	}

	//Evitar de duplicar cpf no banco quando for cadastrar uma pessoa
	public function cpfIgual()
	{
		$sql = new Conexao;

		return $sql->select("SELECT cpf FROM tb_pessoa");		
	}

	//Evitar de duplicar cpf no banco quando for atualizar uma pessoa
	public function cpfIgualUpdate($idPessoa)
	{
		$sql = new Conexao;

		return $sql->select("SELECT cpf FROM tb_pessoa WHERE idPessoa != :idPessoa", [
			":idPessoa" => $idPessoa
		]);
	}

	public function excluirPessoa($idPessoa)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_pessoa WHERE idPessoa = :idPessoa", [
			"idPessoa" => $idPessoa
		]);
	}

}

?>