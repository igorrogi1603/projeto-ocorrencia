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
					":rua" => $endereco->getruaUsuario(),
					":numero" => $endereco->getnumeroUsuario(),
					":bairro" => $endereco->getbairroUsuario(),
					":cidade" => $endereco->getcidadeUsuario(),
					":estado" => $endereco->getestadoUsuario(),
					":complemento" => $endereco->getcomplementoUsuario()
				]);		
				break;

			case 'vitima':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepVitima()),
					":rua" => $endereco->getruaVitima(),
					":numero" => $endereco->getnumeroVitima(),
					":bairro" => $endereco->getbairroVitima(),
					":cidade" => $endereco->getcidadeVitima(),
					":estado" => $endereco->getestadoVitima(),
					":complemento" => $endereco->getcomplementoVitima()
				]);		
				break;

			case 'vitimaCiarApuracao':
				for ($i = 0; $i < count($post); $i++) {
					$aux = $i + 1;
					if (isset($post['nomeVitima'.$aux])) {
					$sql->query("
						INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
						VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
					", [
						":cep" => $validacao->replaceCepBd($post['cepVitima'.$aux]),
						":rua" => $post['ruaVitima'.$aux],
						":numero" => $post['numeroVitima'.$aux],
						":bairro" => $post['bairroVitima'.$aux],
						":cidade" => $post['cidadeVitima'.$aux],
						":estado" => $post['estadoVitima'.$aux],
						":complemento" => $post['complementoVitima'.$aux]
					]);
					}
				}		
				break;

			case 'responsavel':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepResponsavel()),
					":rua" => $endereco->getruaResponsavel(),
					":numero" => $endereco->getnumeroResponsavel(),
					":bairro" => $endereco->getbairroResponsavel(),
					":cidade" => $endereco->getcidadeResponsavel(),
					":estado" => $endereco->getestadoResponsavel(),
					":complemento" => $endereco->getcomplementoResponsavel()
				]);		
				break;

			case 'agressor':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepAgressor()),
					":rua" => $endereco->getruaAgressor(),
					":numero" => $endereco->getnumeroAgressor(),
					":bairro" => $endereco->getbairroAgressor(),
					":cidade" => $endereco->getcidadeAgressor(),
					":estado" => $endereco->getestadoAgressor(),
					":complemento" => $endereco->getcomplementoAgressor()
				]);		
				break;

			case 'instituicao':
				$sql->query("
					INSERT INTO tb_endereco (cep, rua, numero, bairro, cidade, estado, complemento) 
					VALUES(:cep, :rua, :numero, :bairro, :cidade, :estado, :complemento)
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepInstituicao()),
					":rua" => $endereco->getruaInstituicao(),
					":numero" => $endereco->getnumeroInstituicao(),
					":bairro" => $endereco->getbairroInstituicao(),
					":cidade" => $endereco->getcidadeInstituicao(),
					":estado" => $endereco->getestadoInstituicao(),
					":complemento" => $endereco->getcomplementoInstituicao()
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
		$validacao = new Validacao;

		$endereco->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepUsuario()),
					":rua" => $endereco->getruaUsuario(),
					":numero" => $endereco->getnumeroUsuario(),
					":bairro" => $endereco->getbairroUsuario(),
					":cidade" => $endereco->getcidadeUsuario(),
					":estado" => $endereco->getestadoUsuario(),
					":complemento" => $endereco->getcomplementoUsuario(),
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
					":rua" => $endereco->getruaVitima(),
					":numero" => $endereco->getnumeroVitima(),
					":bairro" => $endereco->getbairroVitima(),
					":cidade" => $endereco->getcidadeVitima(),
					":estado" => $endereco->getestadoVitima(),
					":complemento" => $endereco->getcomplementoVitima(),
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
					":rua" => $endereco->getruaResponsavelVitima(),
					":numero" => $endereco->getnumeroResponsavelVitima(),
					":bairro" => $endereco->getbairroResponsavelVitima(),
					":cidade" => $endereco->getcidadeResponsavelVitima(),
					":estado" => $endereco->getestadoResponsavelVitima(),
					":complemento" => $endereco->getcomplementoResponsavelVitima(),
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
					":rua" => $endereco->getruaResponsavel(),
					":numero" => $endereco->getnumeroResponsavel(),
					":bairro" => $endereco->getbairroResponsavel(),
					":cidade" => $endereco->getcidadeResponsavel(),
					":estado" => $endereco->getestadoResponsavel(),
					":complemento" => $endereco->getcomplementoResponsavel(),
					":idEndereco" => $idEndereco
				]);		
				break;

			case 'agressor':
				$sql->query("
					UPDATE tb_endereco 
					SET cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento
					WHERE idEndereco = :idEndereco
				", [
					":cep" => $validacao->replaceCepBd($endereco->getcepAgressor()),
					":rua" => $endereco->getruaAgressor(),
					":numero" => $endereco->getnumeroAgressor(),
					":bairro" => $endereco->getbairroAgressor(),
					":cidade" => $endereco->getcidadeAgressor(),
					":estado" => $endereco->getestadoAgressor(),
					":complemento" => $endereco->getcomplementoAgressor(),
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