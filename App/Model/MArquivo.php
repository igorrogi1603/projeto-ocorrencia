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
			INSERT INTO tb_arquivo (tipo, url) 
			VALUES(:tipo, :url)
		", [
			":tipo" => utf8_decode($tipo),
			":url" => $url
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

}

?>