<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Ocorrencia;

class MOcorrencia {

	public function cadastrar($idApuracao)
	{
		$sql = new Conexao;

		//Status
		//1 = Aberta
		//2 = Reaberta
		//3 = Arquivada
		//4 = Encerrada

		$sql->query("
			INSERT INTO tb_ocorrencia (idCriarApuracao, status, dataCriacao) 
			VALUES(:idCriarApuracao, :status, :dataCriacao)
		", [
			":idCriarApuracao" => $idApuracao,
			":status" => 1,
			":dataCriacao" => date('Y-m-d H:i:s')
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_ocorrencia");
	}

	public function ultimoRegistro()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idOcorrencia) FROM tb_ocorrencia");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	public function reabrirOcorrencia($idOcorrencia)
	{	
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_ocorrencia
			SET status = :status
			WHERE idOcorrencia = :idOcorrencia
		", [
			":status" => 2,
			"idOcorrencia" => $idOcorrencia
		]);
	}

	//Preencher a tabela de arquivar ocorrencia o motivo
	public function tabelaReabrirOcorrencia($idOcorrencia, $post, $idUsuario)
	{
		$sql = new Conexao;
		$ocorrencia = new Ocorrencia;

		$ocorrencia->setData($post);

		$sql->query("
			INSERT INTO tb_reabrirocorrencia (idOcorrencia, idUsuario, motivo) 
			VALUES(:idOcorrencia, :idUsuario, :motivo)
		", [
			":idOcorrencia" => $idOcorrencia,
			":idUsuario" => $idUsuario,
			":motivo" => utf8_decode($ocorrencia->getdescricao())
		]);
	}

	public function arquivarOcorrencia($idOcorrencia)
	{	
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_ocorrencia
			SET status = :status
			WHERE idOcorrencia = :idOcorrencia
		", [
			":status" => 3,
			"idOcorrencia" => $idOcorrencia
		]);
	}

	//Preencher a tabela de arquivar ocorrencia o motivo
	public function tabelaArquivarOcorrencia($idOcorrencia, $post, $idUsuario)
	{
		$sql = new Conexao;
		$ocorrencia = new Ocorrencia;

		$ocorrencia->setData($post);

		$sql->query("
			INSERT INTO tb_arquivarocorrencia (idOcorrencia, idUsuario, motivo) 
			VALUES(:idOcorrencia, :idUsuario, :motivo)
		", [
			":idOcorrencia" => $idOcorrencia,
			":idUsuario" => $idUsuario,
			":motivo" => utf8_decode($ocorrencia->getdescricao())
		]);
	}

	public function encerrarOcorrencia($idOcorrencia)
	{	
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_ocorrencia
			SET status = :status
			WHERE idOcorrencia = :idOcorrencia
		", [
			":status" => 4,
			"idOcorrencia" => $idOcorrencia
		]);
	}

	//Preencher a tabela de arquivar ocorrencia o motivo
	public function tabelaEncerrarOcorrencia($idOcorrencia, $post, $idUsuario)
	{
		$sql = new Conexao;
		$ocorrencia = new Ocorrencia;

		$ocorrencia->setData($post);

		$sql->query("
			INSERT INTO tb_encerrarocorrencia (idOcorrencia, idUsuario, motivo) 
			VALUES(:idOcorrencia, :idUsuario, :motivo)
		", [
			":idOcorrencia" => $idOcorrencia,
			":idUsuario" => $idUsuario,
			":motivo" => utf8_decode($ocorrencia->getdescricao())
		]);
	}

	////////////////////////////////////////////////////////////////////
	//	BLOQUEIO DE OCORRENCIA PARA O USUARIO
	////////////////////////////////////////////////////////////////////

	public function bloquearOcorrenciaUsuario($idApuracao, $idUsuario)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_bloquearocorrenciausuario (idCriarApuracao, idOcorrencia, idUsuario) 
			VALUES(:idCriarApuracao, :idOcorrencia, :idUsuario)
		", [
			":idCriarApuracao" => $idApuracao,
			":idOcorrencia" => null,
			":idUsuario" => $idUsuario
		]);
	}

	public function listaBloquearOcorrenciaUsuario($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * FROM tb_bloquearocorrenciausuario WHERE idUsuario = :idUsuario
		",[
			":idUsuario" => $idUsuario
		]);
	}

	public function listaBloquearOcorrenciaApuracao($idApuracao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * FROM tb_bloquearocorrenciausuario WHERE idCriarApuracao = :idApuracao
		",[
			":idApuracao" => $idApuracao
		]);
	}

	public function listaBloquearOcorrencia($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT * FROM tb_bloquearocorrenciausuario WHERE idOcorrencia = :idOcorrencia
		",[
			":idOcorrencia" => $idOcorrencia
		]);
	}

	public function cadastrarBloquearOcorrencia($idOcorrencia, $idApuracao)
	{
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_bloquearocorrenciausuario
			SET idOcorrencia = :idOcorrencia
			WHERE idCriarApuracao = :idCriarApuracao
		", [
			":idOcorrencia" => $idOcorrencia,
			"idCriarApuracao" => $idApuracao
		]);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Listar todos os dados da ocorrencia como pessoas envolvidas, endereco, contato, dados da apuracao
	public function listaOcorrenciaCompleta()
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idOcorrencia, a.status statusOcorrencia, a.dataCriacao dataCriacaoOcorrencia, a.dataRegistro dataRegistroOcorrencia,
			b.idCriarApuracao, b.idUsuario, b.tipoApuracao, b.descricao, b.status statusApuracao, 
			b.dataCriacao dataCriacaoApuracao, b.dataRegistro dataRegistroApuracao,
			c.idVitimasCriarApuracao, c.idVitimasApuracao,
			d.idPessoa idPessoaVitima,
			e.qualFamilia, 
			f.idResponsavelVitimas,
			g.idPessoa idPessoaResponsavel, g.isPais, g.outro, g.idResponsavelApuracao, g.isAindaResponsavel,
			h.nome nomeVitima, h.sexo sexoVitima, h.cpf cpfVitima, h.dataNasc dataNascVitima, h.rg rgVitima, 
			i.nome nomeResponsavel, i.cpf cpfResponsavel, i.sexo sexoResponsavel, i.dataNasc dataNascResponsavel, i.rg rgResponsavel,
			j.idContato idContatoVitima, j.celular celularVitima, j.fixo fixoVitima, j.email emailVitima,
			k.idContato idContatoResponsavel, k.celular celularResponsavel, k.fixo fixoResponsavel, k.email emailResponsavel,
			l.idEndereco idEnderecoVitima, l.cep cepVitima, l.rua ruaVitima, l.numero numeroVitima, l.bairro bairroVitima, 
			l.cidade cidadeVitima, l.estado estadoVitima, l.complemento complementoVitima,
			m.idEndereco idEnderecoResponsavel, m.cep cepResponsavel, m.rua ruaResponsavel, m.numero numeroResponsavel, 
			m.bairro bairroResponsavel, 
			m.cidade cidadeResponsavel, m.estado estadoResponsavel, m.complemento complementoResponsavel
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelVitimas f ON d.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao g ON f.idResponsavelApuracao = g.idResponsavelApuracao
			INNER JOIN tb_pessoa h ON d.idPessoa = h.idPessoa
			INNER JOIN tb_pessoa i ON g.idPessoa = i.idPessoa
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_contato k ON i.idContato = k.idContato
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
			INNER JOIN tb_endereco m ON i.idEndereco = m.idEndereco
			ORDER BY a.idOcorrencia DESC
		");
	}

	//Listar ocorrencia unica
	public function listaOcorrencia($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idOcorrencia, a.status statusOcorrencia, a.dataCriacao dataCriacaoOcorrencia, a.dataRegistro dataRegistroOcorrencia,
			b.idCriarApuracao, b.idUsuario, b.tipoApuracao, b.descricao, b.status statusApuracao, 
			b.dataCriacao dataCriacaoApuracao, b.dataRegistro dataRegistroApuracao,
			c.idVitimasCriarApuracao, c.idVitimasApuracao,
			d.idPessoa idPessoaVitima,
			e.qualFamilia, 
			f.idResponsavelVitimas,
			g.idPessoa idPessoaResponsavel, g.isPais, g.outro, g.idResponsavelApuracao, g.isAindaResponsavel,
			h.nome nomeVitima, h.sexo sexoVitima, h.cpf cpfVitima, h.dataNasc dataNascVitima, h.rg rgVitima, 
			i.nome nomeResponsavel, i.cpf cpfResponsavel, i.sexo sexoResponsavel, i.dataNasc dataNascResponsavel, i.rg rgResponsavel,
			j.idContato idContatoVitima, j.celular celularVitima, j.fixo fixoVitima, j.email emailVitima,
			k.idContato idContatoResponsavel, k.celular celularResponsavel, k.fixo fixoResponsavel, k.email emailResponsavel,
			l.idEndereco idEnderecoVitima, l.cep cepVitima, l.rua ruaVitima, l.numero numeroVitima, l.bairro bairroVitima, 
			l.cidade cidadeVitima, l.estado estadoVitima, l.complemento complementoVitima,
			m.idEndereco idEnderecoResponsavel, m.cep cepResponsavel, m.rua ruaResponsavel, m.numero numeroResponsavel, 
			m.bairro bairroResponsavel, 
			m.cidade cidadeResponsavel, m.estado estadoResponsavel, m.complemento complementoResponsavel
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelVitimas f ON d.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao g ON f.idResponsavelApuracao = g.idResponsavelApuracao
			INNER JOIN tb_pessoa h ON d.idPessoa = h.idPessoa
			INNER JOIN tb_pessoa i ON g.idPessoa = i.idPessoa
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_contato k ON i.idContato = k.idContato
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
			INNER JOIN tb_endereco m ON i.idEndereco = m.idEndereco
			WHERE a.idOcorrencia = :idOcorrencia
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

	public function listaOcorrenciaVitimaCompleta($idVitima, $idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idOcorrencia, a.status statusOcorrencia, a.dataCriacao dataCriacaoOcorrencia, a.dataRegistro dataRegistroOcorrencia,
			b.idCriarApuracao, b.idUsuario, b.tipoApuracao, b.descricao, b.status statusApuracao, 
			b.dataCriacao dataCriacaoApuracao, b.dataRegistro dataRegistroApuracao,
			c.idVitimasCriarApuracao, c.idVitimasApuracao,
			d.idPessoa idPessoaVitima,
			e.qualFamilia, 
			f.idResponsavelVitimas,
			g.idPessoa idPessoaResponsavel, g.isPais, g.outro, g.idResponsavelApuracao, g.isAindaResponsavel,
			h.nome nomeVitima, h.sexo sexoVitima, h.cpf cpfVitima, h.dataNasc dataNascVitima, h.rg rgVitima, 
			i.nome nomeResponsavel, i.cpf cpfResponsavel, i.sexo sexoResponsavel, i.dataNasc dataNascResponsavel, i.rg rgResponsavel,
			j.idContato idContatoVitima, j.celular celularVitima, j.fixo fixoVitima, j.email emailVitima,
			k.idContato idContatoResponsavel, k.celular celularResponsavel, k.fixo fixoResponsavel, k.email emailResponsavel,
			l.idEndereco idEnderecoVitima, l.cep cepVitima, l.rua ruaVitima, l.numero numeroVitima, l.bairro bairroVitima, 
			l.cidade cidadeVitima, l.estado estadoVitima, l.complemento complementoVitima,
			m.idEndereco idEnderecoResponsavel, m.cep cepResponsavel, m.rua ruaResponsavel, m.numero numeroResponsavel, 
			m.bairro bairroResponsavel, 
			m.cidade cidadeResponsavel, m.estado estadoResponsavel, m.complemento complementoResponsavel,
			n.setor,
			o.nome quemCriouApuracao
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelVitimas f ON d.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao g ON f.idResponsavelApuracao = g.idResponsavelApuracao
			INNER JOIN tb_pessoa h ON d.idPessoa = h.idPessoa
			INNER JOIN tb_pessoa i ON g.idPessoa = i.idPessoa
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_contato k ON i.idContato = k.idContato
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
			INNER JOIN tb_endereco m ON i.idEndereco = m.idEndereco
			INNER JOIN tb_usuario n ON b.idUsuario = n.idUsuario
			INNER JOIN tb_pessoa o ON n.idPessoa = o.idPessoa
			WHERE a.idOcorrencia = :idOcorrencia AND c.idVitimasApuracao = :idVitima
		", [
			":idOcorrencia" => $idOcorrencia,
			":idVitima" => $idVitima
		]);
	}

}

?>