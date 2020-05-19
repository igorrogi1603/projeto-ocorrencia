<?php

namespace App\Controller;

use \App\Model\MAveriguacao;

class CCriarAveriguacao {

	public static function postCriarAveriguacao($post)
	{
		
		$maveriguacao = new MAveriguacao;

		$maveriguacao->cadastrar($post);

	}

	public static function getAveriguacao()
	{

		$maveriguacao = new MAveriguacao;

		$lista = $maveriguacao->listNaoLidas();

		foreach ($lista as $value) {
			$value['titulo'] = $value['titulo'];
			$value['mensagem'] = $value['mensagem'];
		}

		return $lista;

	}

	public function getAveriguacaoLida()
	{

		$maveriguacao = new MAveriguacao;

		$lista = $maveriguacao->listLidas();

		foreach ($lista as $value) {
			$value['titulo'] = $value['titulo'];
			$value['mensagem'] = $value['mensagem'];
		}

		return $lista;

	}

	public static function getAveriguacaoDetalhe($idAveriguacao)
	{

		$maveriguacao = new MAveriguacao;

		$lista = $maveriguacao->listEspecifico($idAveriguacao);

		foreach ($lista as $value) {
			$value['titulo'] = $value['titulo'];
			$value['mensagem'] = $value['mensagem'];
		}

		foreach ($lista as $value) {
			$listaNova = $value;
		}

		return $listaNova;

	}

	public static function getAveriguacaoDetalheLida($idAveriguacao)
	{

		$maveriguacao = new MAveriguacao;

		$lista = $maveriguacao->updateStatusEspecifico($idAveriguacao);

	}

}

?>