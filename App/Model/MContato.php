<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Contato;
use \App\Classe\Validacao;

class MContato {

	public function cadastrar($post, $complemento)
	{

		$sql = new Conexao;

		$contato = new Contato;
		$validacao = new Validacao;

		$contato->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					INSERT INTO tb_contato (celular, fixo, email) 
					VALUES(:celular, :fixo, :email)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularUsuario()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoUsuario()),
					":email" => utf8_decode($contato->getemailUsuario())
				]);				
				break;
			
			case 'vitima':
				$sql->query("
					INSERT INTO tb_contato (celular) 
					VALUES(:celular)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularVitima())
				]);				
				break;

			case 'responsavelVitima':
				$sql->query("
					INSERT INTO tb_contato (celular) 
					VALUES(:celular)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularResponsavelVitima())
				]);				
				break;

			case 'responsavel':
				$sql->query("
					INSERT INTO tb_contato (celular, fixo, email) 
					VALUES(:celular, :fixo, :email)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularResponsavel()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoResponsavel()),
					":email" => utf8_decode($contato->getemailResponsavel())
				]);				
				break;

			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	public function update($post, $idContato, $complemento)
	{
		$sql = new Conexao;

		$contato = new Contato;
		$validacao = new Validacao;		

		$contato->setData($post);

		switch ($complemento) {
			case 'usuario':
				$sql->query("
					UPDATE tb_contato 
					SET celular = :celular, fixo = :fixo, email = :email
					WHERE idContato = :idContato
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularUsuario()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoUsuario()),
					":email" => utf8_decode($contato->getemailUsuario()),
					":idContato" => $idContato
				]);			
				break;
			
			case 'vitima':
				$sql->query("
					UPDATE tb_contato 
					SET celular = :celular, fixo = :fixo, email = :email
					WHERE idContato = :idContato
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularVitima()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoVitima()),
					":email" => utf8_decode($contato->getemailVitima()),
					":idContato" => $idContato
				]);			
				break;

			case 'responsavelVitima':
				$sql->query("
					UPDATE tb_contato 
					SET celular = :celular, fixo = :fixo, email = :email
					WHERE idContato = :idContato
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularResponsavelVitima()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoResponsavelVitima()),
					":email" => utf8_decode($contato->getemailResponsavelVitima()),
					":idContato" => $idContato
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

		return $sql->select("SELECT * FROM tb_contato");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idContato) FROM tb_contato");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function excluirContato($idContato)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_contato WHERE idContato = :idContato", [
			"idContato" => $idContato
		]);
	}

}

?>