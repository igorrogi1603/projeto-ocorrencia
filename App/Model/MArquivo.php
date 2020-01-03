<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Arquivo;

class MArquivo {

	//Cadastrando na tb_arquivo
	public function cadastrarArquivo($tipo, $url)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_arquivo (tipo, url, status) 
			VALUES(:tipo, :url, :status)
		", [
			":tipo" => utf8_decode($tipo),
			":url" => $url,
			":status" => 0
		]);
	}

	//Cadastrando na tb_arquivo
	public function cadastrarArquivosPessoa($idPessoa, $tipo, $url)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_arquivospessoa (idPessoa, tipo, url, status) 
			VALUES(:idPessoa, :tipo, :url, :status)
		", [
			":idPessoa" => $idPessoa,
			":tipo" => utf8_decode($tipo),
			":url" => $url,
			":status" => 0
		]);
	}

	public function cadastrarArquivoOcorrencia($idOcorrencia, $idArquivo)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_arquivosprocessoocorrencia (idOcorrencia, idArquivo) 
			VALUES(:idOcorrencia, :idArquivo)
		", [
			":idOcorrencia" => $idOcorrencia,
			":idArquivo" => $idArquivo
		]);
	}

	//Buscando ultimo registro na tabela tb_arquivo
	public function ultimoRegistroArquivo()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idArquivo) FROM tb_arquivo");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Buscando ultimo registro na tabela tb_arquivospessoa
	public function ultimoRegistroArquivosPessoa()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idArquivosPessoa) FROM tb_arquivospessoa");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function pesquisarArquivo($url)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_arquivo WHERE url = :url", [
			":url" => $url
		]);
	}

	public function listaArquivosPessoa($idPessoa)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * 
			FROM tb_arquivospessoa a
			INNER JOIN tb_pessoa b ON a.idPessoa = b.idPessoa
			WHERE a.idPessoa = :idPessoa
		", [
			":idPessoa" => $idPessoa
		]);	
	}

	public function atualizarStatus($idArquivo, $status)
	{
		$sql = new Conexao;
		
		$sql->query("
			UPDATE tb_arquivo 
			SET status = :status
			WHERE idArquivo = :idArquivo
		", [
			":status" => $status,
			":idArquivo" => $idArquivo
		]);
	}

	public function atualizarStatusArquivosPessoa($idArquivosPessoa, $status)
	{
		$sql = new Conexao;
		
		$sql->query("
			UPDATE tb_arquivospessoa 
			SET status = :status
			WHERE idArquivosPessoa = :idArquivosPessoa
		", [
			":status" => $status,
			":idArquivosPessoa" => $idArquivosPessoa
		]);
	}

	public function arquivosOcorencia($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * 
			FROM tb_arquivosprocessoocorrencia a
			INNER JOIN tb_arquivo b ON a.idArquivo = b.idArquivo
			WHERE idOcorrencia = :idOcorrencia
			ORDER BY b.idArquivo ASC
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

}

?>