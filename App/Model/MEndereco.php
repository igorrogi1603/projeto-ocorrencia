<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Endereco;
use \App\Classe\Validacao;

class MEndereco {

	public function cadastrar($post, $complemento)
	{

		$sql = new Conexao;

		$endereco = new Endereco;
		$validacao = new Validacao;

		$endereco->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepUsuario()),
					":rua" => utf8_decode($endereco->getruaUsuario()),
					":numero" => $endereco->getnumeroUsuario(),
					":bairro" => utf8_decode($endereco->getbairroUsuario()),
					":cidade" => utf8_decode($endereco->getcidadeUsuario()),
					":estado" => $endereco->getestadoUsuario(),
					":complemento" => utf8_decode($endereco->getcomplementoUsuario())
				]);		
				break;

			case 'vitima':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepVitima()),
					":rua" => utf8_decode($endereco->getruaVitima()),
					":numero" => $endereco->getnumeroVitima(),
					":bairro" => utf8_decode($endereco->getbairroVitima()),
					":cidade" => utf8_decode($endereco->getcidadeVitima()),
					":estado" => $endereco->getestadoVitima(),
					":complemento" => utf8_decode($endereco->getcomplementoVitima())
				]);		
				break;

			case 'responsavel':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepResponsavel()),
					":rua" => utf8_decode($endereco->getruaResponsavel()),
					":numero" => $endereco->getnumeroResponsavel(),
					":bairro" => utf8_decode($endereco->getbairroResponsavel()),
					":cidade" => utf8_decode($endereco->getcidadeResponsavel()),
					":estado" => $endereco->getestadoResponsavel(),
					":complemento" => utf8_decode($endereco->getcomplementoResponsavel())
				]);		
				break;

			case 'agressor':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepAgressor()),
					":rua" => utf8_decode($endereco->getruaAgressor()),
					":numero" => $endereco->getnumeroAgressor(),
					":bairro" => utf8_decode($endereco->getbairroAgressor()),
					":cidade" => utf8_decode($endereco->getcidadeAgressor()),
					":estado" => $endereco->getestadoAgressor(),
					":complemento" => utf8_decode($endereco->getcomplementoAgressor())
				]);		
				break;

			case 'instituicao':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepInstituicao()),
					":rua" => utf8_decode($endereco->getruaInstituicao()),
					":numero" => $endereco->getnumeroInstituicao(),
					":bairro" => utf8_decode($endereco->getbairroInstituicao()),
					":cidade" => utf8_decode($endereco->getcidadeInstituicao()),
					":estado" => $endereco->getestadoInstituicao(),
					":complemento" => utf8_decode($endereco->getcomplementoInstituicao())
				]);		
				break;

			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	public function update($post, $idEndereco, $complemento)
	{
		$sql = new Conexao;

		$endereco = new Endereco;

		$endereco->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepUsuario()),
					":rua" => utf8_decode($endereco->getruaUsuario()),
					":numero" => $endereco->getnumeroUsuario(),
					":bairro" => utf8_decode($endereco->getbairroUsuario()),
					":cidade" => utf8_decode($endereco->getcidadeUsuario()),
					":estado" => $endereco->getestadoUsuario(),
					":complemento" => utf8_decode($endereco->getcomplementoUsuario()),
					":idEndereco" => $idEndereco
				]);
				break;

			case 'vitima':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepVitima()),
					":rua" => utf8_decode($endereco->getruaVitima()),
					":numero" => $endereco->getnumeroVitima(),
					":bairro" => utf8_decode($endereco->getbairroVitima()),
					":cidade" => utf8_decode($endereco->getcidadeVitima()),
					":estado" => $endereco->getestadoVitima(),
					":complemento" => utf8_decode($endereco->getcomplementoVitima()),
					":idEndereco" => $idEndereco
				]);		
				break;

			case 'responsavelVitima':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepResponsavelVitima()),
					":rua" => utf8_decode($endereco->getruaResponsavelVitima()),
					":numero" => $endereco->getnumeroResponsavelVitima(),
					":bairro" => utf8_decode($endereco->getbairroResponsavelVitima()),
					":cidade" => utf8_decode($endereco->getcidadeResponsavelVitima()),
					":estado" => $endereco->getestadoResponsavelVitima(),
					":complemento" => utf8_decode($endereco->getcomplementoResponsavelVitima()),
					":idEndereco" => $idEndereco
				]);		
				break;

			case 'responsavel':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepResponsavel()),
					":rua" => utf8_decode($endereco->getruaResponsavel()),
					":numero" => $endereco->getnumeroResponsavel(),
					":bairro" => utf8_decode($endereco->getbairroResponsavel()),
					":cidade" => utf8_decode($endereco->getcidadeResponsavel()),
					":estado" => $endereco->getestadoResponsavel(),
					":complemento" => utf8_decode($endereco->getcomplementoResponsavel()),
					":idEndereco" => $idEndereco
				]);		
				break;

			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_endereco");
	}

	public function enderecoEspecifico($idEndereco)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_endereco WHERE idEndereco = :idEndereco", [
			"idEndereco" => $idEndereco
		]);
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idEndereco) FROM tb_endereco");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function excluirEndereco($idEndereco)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_endereco WHERE idEndereco = :idEndereco", [
			"idEndereco" => $idEndereco
		]);
	}

}

?>