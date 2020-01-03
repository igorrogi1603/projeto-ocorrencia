<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Responsavel;
use \App\Classe\Validacao;

class MResponsavel {

	public function cadastrar($idPessoa, $complemento, $post)
	{
		$sql = new Conexao;

		$responsavel = new Responsavel;
		$validacao = new Validacao;

		switch ($complemento) {
			case 'apuracao':

				//isPais
				//1 = pai
				//2 = mae
				//3 = outro

				//isAindaResponsavel
				//1 = sim
				//0 = não

				$sql->query("
					INSERT INTO tb_responsavelapuracao (idPessoa, isPais, isAindaResponsavel) 
					VALUES(:idPessoa, :isPais, :isAindaResponsavel)
				", [
					":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"],
					":isPais" => 1,
					":isAindaResponsavel" => 1
				]);
				break;

			case 'ocorrencia':
				$responsavel->setData($post);
				$sql->query("
					INSERT INTO tb_responsavelapuracao (idPessoa, isPais, isAindaResponsavel, outro) 
					VALUES(:idPessoa, :isPais, :isAindaResponsavel, :outro)
				", [
					":idPessoa" => (int)$idPessoa[0]["MAX(idPessoa)"],
					":isPais" => $responsavel->getresponsavelRadio(),
					":isAindaResponsavel" => 1,
					":outro" => utf8_decode($responsavel->getresponsavelOutro())
				]);
				break;
			
			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}
	}

	public function cadastrarResponsavelVitimas($idResponsavel, $idVitima, $complemento)
	{
		$sql = new Conexao;

		switch ($complemento) {
			case 'apuracao':
				$sql->query("
					INSERT INTO tb_responsavelvitimas (idResponsavelApuracao, idVitimasApuracao) 
					VALUES(:idResponsavelApuracao, :idVitimasApuracao)
				", [
					":idResponsavelApuracao" => (int)$idResponsavel[0]["MAX(idResponsavelApuracao)"],
					":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"]
				]);
				break;

			case 'ocorrencia':
				$sql->query("
					INSERT INTO tb_responsavelvitimas (idResponsavelApuracao, idVitimasApuracao) 
					VALUES(:idResponsavelApuracao, :idVitimasApuracao);
				", [
					":idResponsavelApuracao" => (int)$idResponsavel[0]["MAX(idResponsavelApuracao)"],
					":idVitimasApuracao" => $idVitima
				]);
				break;
			
			default:
				var_dump("Não foi possivel cadastrar");
				exit;
				break;
		}	
	}

	//Atualizar o responsavel da vitima
	public function updateResponsavelApuracao($post, $idPessoaResponsavel)
	{
		$sql = new Conexao;
		$responsavel = new Responsavel;

		$responsavel->setData($post);

		$sql->query("
			UPDATE tb_responsavelapuracao 
			SET isPais = :isPais, outro = :outro
			WHERE idPessoa = :idPessoa
		", [
			":isPais" => $responsavel->getresponsavelRadio(),
			":outro" => utf8_decode($responsavel->getresponsavelOutro()),
			":idPessoa" => $idPessoaResponsavel
		]);
	}

	public function updateIsAindaResponsavel($isAindaResponsavel, $idResponsavelApuracao)
	{
		$sql = new Conexao;
		
		$sql->query("
			UPDATE tb_responsavelapuracao 
			SET isAindaResponsavel = :isAindaResponsavel
			WHERE idResponsavelApuracao = :idResponsavelApuracao
		", [
			":isAindaResponsavel" => $isAindaResponsavel,
			":idResponsavelApuracao" => $idResponsavelApuracao
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_responsavelapuracao");
	}

	//Listar responsavel expecifico
	public function listResponsavel($idResponsavel)
	{
		$sql = new Conexao;

		return $sql->select("SELECT a.idResponsavelApuracao, a.idPessoa FROM tb_responsavelapuracao a WHERE idResponsavelApuracao = :idResponsavel", [
			":idResponsavel" => $idResponsavel
		]);	
	}

	public function ultimoRegistro()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idResponsavelApuracao) FROM tb_responsavelapuracao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function cadastrarMotivoDescartarResponsavel($idResponsavelApuracao, $post, $idCriarApuracao, $idUsuario) 
	{
		$sql = new Conexao;
		$responsavel = new Responsavel;

		$responsavel->setData($post);

		$sql->query("
			INSERT INTO tb_responsavelexcluido (idUsuario, idResponsavelApuracao, idCriarApuracao, motivo) 
			VALUES(:idUsuario, :idResponsavelApuracao, :idCriarApuracao, :motivo)
		", [
			":idUsuario" => $idUsuario,
			":idResponsavelApuracao" => $idResponsavelApuracao,
			":idCriarApuracao" => $idCriarApuracao,
			":motivo" => $responsavel->getdescricao()
		]);	
	}

	public function listaResponsavelExcluido($idResponsavelApuracao)
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT * FROM tb_responsavelexcluido WHERE idResponsavelApuracao = :idResponsavelApuracao", [
			":idResponsavelApuracao" => $idResponsavelApuracao
		]);

		if ($qtd != null) {
			return $qtd;
		} else {
			return false;
		}
	}

	public function responsavelEspecifico($idResponsavelApuracao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT
			a.isPais, a.isAindaResponsavel, a.outro,
			b.idPessoa, b.nome, b.dataNasc, b.cpf, b.rg, b.sexo, b.dataRegistro,
			c.idEndereco, c.cep, c.rua, c.bairro, c.numero, c.cidade, c.estado, c.complemento,
			d.idContato, d.celular, d.fixo, d.email
			FROM tb_responsavelapuracao a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa
			INNER JOIN tb_endereco c ON b.idEndereco = c.idEndereco
			INNER JOIN tb_contato d ON b.idContato = d.idContato
			WHERE a.idResponsavelApuracao = :idResponsavelApuracao
		", [
			":idResponsavelApuracao" => $idResponsavelApuracao
		]);
	}

}

?>