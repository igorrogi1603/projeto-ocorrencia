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
			$dados[$i]['nome'] = utf8_encode($dados[$i]['nome']);
			$dados[$i]['setor'] = utf8_encode($dados[$i]['setor']);
			$dados[$i]['funcao'] = utf8_encode($dados[$i]['funcao']);
			$dados[$i]['isCpf'] = '1';
		}

		//corrigindo caracteres
		for ($i = 0; $i < count($dadosInstituicao); $i++) {
			$dadosInstituicao[$i]['nome'] = utf8_encode($dadosInstituicao[$i]['nome']);
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

		return $arrayNovo;
	}

}

?>