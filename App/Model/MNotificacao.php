<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Notificacao;
use \App\Classe\Validacao;

class MNotificacao {

	public function cadastrar($tipo, $url, $para = null)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_notificacoes (idUsuario, tipo, url) 
			VALUES(:idUsuario, :tipo, :url)
		", [
			":idUsuario" => $para,
			":tipo" => $tipo,
			":url" => $url
		]);
	}

	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_notificacoes");
	}

	public function excluirNotificacao($idNotificacao)
	{
		$sql = new Conexao;

		$sql->query("DELETE FROM tb_notificacoes WHERE idNotificacoes = :idNotificacao", [
			":idNotificacao" => $idNotificacao
		]);		
	}

}

?>