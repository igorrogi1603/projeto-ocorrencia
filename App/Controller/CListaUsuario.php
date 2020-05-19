<?php

namespace App\Controller;

use \App\Model\MUsuario;

class CListaUsuario {

	public static function getListaUsuario()
	{
		//instancia
		$musuario = new MUsuario;

		//buscando os dados do banco
		$dados = $musuario->listaUsuario();
		$dadosInstituicao = $musuario->listaUsuarioInstituicao();

		//corrigindo caracteres
		for ($i = 0; $i < count($dados); $i++) {
			$dados[$i]['nome'] = $dados[$i]['nome'];
			$dados[$i]['setor'] = $dados[$i]['setor'];
			$dados[$i]['funcao'] = $dados[$i]['funcao'];
			$dados[$i]['isCpf'] = '1';
		}

		//corrigindo caracteres
		for ($i = 0; $i < count($dadosInstituicao); $i++) {
			$dadosInstituicao[$i]['nome'] = $dadosInstituicao[$i]['nome'];
			$dadosInstituicao[$i]['isCpf'] = '0';
		}

		//juntando o array 
		foreach ($dados as $value) {
			$arrayNovo[] = $value;
		}

		//juntando o array 
		foreach ($dadosInstituicao as $value) {
			$arrayNovo[] = $value;
		}

		for ($i = 0; $i < count($arrayNovo); $i++) {
			if (!isset($arrayNovo[$i]['subnome']) || $arrayNovo[$i]['subnome'] == null || $arrayNovo[$i]['subnome'] == "") {
				$arrayNovo[$i]['subnome'] = "Null";
			}

			if (!isset($arrayNovo[$i]['status'])) {
				$arrayNovo[$i]['status'] = 3;
			}			
		}

		if (isset($arrayNovo) && $arrayNovo != null && $arrayNovo != "") {
			return $arrayNovo;
		} else {
			return false;
		}
	}

}

?>