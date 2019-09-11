<?php

namespace App\Controller;

use \App\Model\MUsuario;
use \App\Classe\Pessoa;
use \App\Classe\Validacao;

class CDetalheUsuario {

	public static function getDetalheUsuario($idUsuario)
	{
		$musuario = new MUsuario;
		$pessoa = new Pessoa;
		$validacao = new Validacao;

		$dados = $musuario->detalheUsuario($idUsuario);

		$dados[0]['rua'] = utf8_encode($dados[0]['rua']);
		$dados[0]['setor'] = utf8_encode($dados[0]['setor']);
		$dados[0]['qtdAnos'] = $pessoa->qtdAnos($dados[0]['dataNasc']);
		$dados[0]['dataNasc'] = $validacao->replaceDataView($dados[0]['dataNasc']);
		$dados[0]['cpf'] = $validacao->replaceCpfView($dados[0]['cpf']);
		$dados[0]['rg'] = $validacao->replaceRgView($dados[0]['rg']);
		$dados[0]['celular'] = $validacao->replaceCelularView($dados[0]['celular']);
		$dados[0]['fixo'] = $validacao->replaceTelefoneFixoView($dados[0]['fixo']);
		$dados[0]['cep'] = $validacao->replaceCepView($dados[0]['cep']);
		$dados[0]['estado'] = strtoupper($dados[0]['estado']);

		if ($dados[0]['sexo'] == 'm') {
			$dados[0]['sexo'] = "Masculino";
		} else if ($dados[0]['sexo'] == 'f') {
			$dados[0]['sexo'] = "Feminino";
		}
		
		return $dados[0];
	}

}

?>