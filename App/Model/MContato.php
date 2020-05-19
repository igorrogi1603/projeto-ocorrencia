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
					":email" => $contato->getemailUsuario()
				]);				
				break;

			case 'vitimaCiarApuracao':
				for ($i = 0; $i < count($post); $i++) {
					$aux = $i + 1;
					if (isset($post['nomeVitima'.$aux])) {
						$sql->query("
							INSERT INTO tb_contato (celular) 
							VALUES(:celular)
						", [
							":celular" => $validacao->replaceCelularBd($post['celularVitima'.$aux])
						]);
					}
				}			
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
					":email" => $contato->getemailResponsavel()
				]);				
				break;

			case 'agressor':
				$sql->query("
					INSERT INTO tb_contato (celular, fixo, email) 
					VALUES(:celular, :fixo, :email)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularAgressor()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoAgressor()),
					":email" => $contato->getemailAgressor()
				]);				
				break;

			case 'instituicao':
				$sql->query("
					INSERT INTO tb_contato (celular, fixo, email) 
					VALUES(:celular, :fixo, :email)
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularInstituicao()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoInstituicao()),
					":email" => $contato->getemailInstituicao()
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
					":email" => $contato->getemailUsuario(),
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
					":email" => $contato->getemailVitima(),
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
					":email" => $contato->getemailResponsavelVitima(),
					":idContato" => $idContato
				]);				
				break;

			case 'responsavel':
				$sql->query("
					UPDATE tb_contato 
					SET celular = :celular, fixo = :fixo, email = :email
					WHERE idContato = :idContato
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularResponsavel()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoResponsavel()),
					":email" => $contato->getemailResponsavel(),
					":idContato" => $idContato
				]);				
				break;

			case 'agressor':
				$sql->query("
					UPDATE tb_contato 
					SET celular = :celular, fixo = :fixo, email = :email
					WHERE idContato = :idContato
				", [
					":celular" => $validacao->replaceCelularBd($contato->getcelularAgressor()),
					":fixo" => $validacao->replaceTelefoneFixoBd($contato->gettelFixoAgressor()),
					":email" => $contato->getemailAgressor(),
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