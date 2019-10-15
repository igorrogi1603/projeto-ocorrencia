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

	public function pesquisarArquivo($url)
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_arquivo WHERE url = :url", [
			"url" => $url
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
			"idArquivo" => $idArquivo
		]);
	}

}

?>