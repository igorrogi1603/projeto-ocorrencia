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
			d.idPessoa idPessoaVitima, d.idResponsavelApuracao,
			e.qualFamilia, f.idPessoa idPessoaResponsavel,
			g.nome nomeVitima, g.sexo sexoVitima, g.cpf cpfVitima, g.dataNasc dataNascVitima, g.rg rgVitima, 
			h.nome nomeResponsavel, h.cpf cpfResponsavel,
			i.idContato idContatoVitima, i.celular celularVitima, i.fixo fixoVitima, i.email emailVitima,
			j.idContato idContatoResponsavel, j.celular celularResponsavel, j.fixo fixoResponsavel, j.email emailResponsavel,
			k.idEndereco idEnderecoVitima, k.cep cepVitima, k.rua ruaVitima, k.numero numeroVitima, k.bairro bairroVitima, 
			k.cidade cidadeVitima, k.estado estadoVitima, k.complemento complementoVitima,
			l.idEndereco idEnderecoResponsavel, l.cep cepResponsavel, l.rua ruaResponsavel, l.numero numeroResponsavel, 
			l.bairro bairroResponsavel, 
			l.cidade cidadeResponsavel, l.estado estadoResponsavel, l.complemento complementoResponsavel
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao f ON d.idResponsavelApuracao = f.idResponsavelApuracao
			INNER JOIN tb_pessoa g ON d.idPessoa = g.idPessoa
			INNER JOIN tb_pessoa h ON f.idPessoa = h.idPessoa
			INNER JOIN tb_contato i ON g.idContato = i.idContato
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_endereco k ON g.idEndereco = k.idEndereco
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
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
			d.idPessoa idPessoaVitima, d.idResponsavelApuracao,
			e.qualFamilia, f.idPessoa idPessoaResponsavel,
			g.nome nomeVitima, g.sexo sexoVitima, g.cpf cpfVitima, g.dataNasc dataNascVitima, g.rg rgVitima, 
			h.nome nomeResponsavel, h.cpf cpfResponsavel,
			i.idContato idContatoVitima, i.celular celularVitima, i.fixo fixoVitima, i.email emailVitima,
			j.idContato idContatoResponsavel, j.celular celularResponsavel, j.fixo fixoResponsavel, j.email emailResponsavel,
			k.idEndereco idEnderecoVitima, k.cep cepVitima, k.rua ruaVitima, k.numero numeroVitima, k.bairro bairroVitima, 
			k.cidade cidadeVitima, k.estado estadoVitima, k.complemento complementoVitima,
			l.idEndereco idEnderecoResponsavel, l.cep cepResponsavel, l.rua ruaResponsavel, l.numero numeroResponsavel, 
			l.bairro bairroResponsavel, 
			l.cidade cidadeResponsavel, l.estado estadoResponsavel, l.complemento complementoResponsavel
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao f ON d.idResponsavelApuracao = f.idResponsavelApuracao
			INNER JOIN tb_pessoa g ON d.idPessoa = g.idPessoa
			INNER JOIN tb_pessoa h ON f.idPessoa = h.idPessoa
			INNER JOIN tb_contato i ON g.idContato = i.idContato
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_endereco k ON g.idEndereco = k.idEndereco
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
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
			d.idPessoa idPessoaVitima, d.idResponsavelApuracao,
			e.qualFamilia, f.idPessoa idPessoaResponsavel,
			g.nome nomeVitima, g.sexo sexoVitima, g.cpf cpfVitima, g.dataNasc dataNascVitima, g.rg rgVitima, 
			h.nome nomeResponsavel, h.cpf cpfResponsavel,
			i.idContato idContatoVitima, i.celular celularVitima, i.fixo fixoVitima, i.email emailVitima,
			j.idContato idContatoResponsavel, j.celular celularResponsavel, j.fixo fixoResponsavel, j.email emailResponsavel,
			k.idEndereco idEnderecoVitima, k.cep cepVitima, k.rua ruaVitima, k.numero numeroVitima, k.bairro bairroVitima, 
			k.cidade cidadeVitima, k.estado estadoVitima, k.complemento complementoVitima,
			l.idEndereco idEnderecoResponsavel, l.cep cepResponsavel, l.rua ruaResponsavel, l.numero numeroResponsavel, 
			l.bairro bairroResponsavel, 
			l.cidade cidadeResponsavel, l.estado estadoResponsavel, l.complemento complementoResponsavel
			FROM tb_ocorrencia a
			INNER JOIN tb_criarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimascriarapuracao c ON b.idCriarApuracao = c.idCriarApuracao
			INNER JOIN tb_vitimasapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_familiaapuracao e ON d.idVitimasApuracao = e.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao f ON d.idResponsavelApuracao = f.idResponsavelApuracao
			INNER JOIN tb_pessoa g ON d.idPessoa = g.idPessoa
			INNER JOIN tb_pessoa h ON f.idPessoa = h.idPessoa
			INNER JOIN tb_contato i ON g.idContato = i.idContato
			INNER JOIN tb_contato j ON h.idContato = j.idContato
			INNER JOIN tb_endereco k ON g.idEndereco = k.idEndereco
			INNER JOIN tb_endereco l ON h.idEndereco = l.idEndereco
			WHERE a.idOcorrencia = :idOcorrencia AND c.idVitimasApuracao = :idVitima
		", [
			":idOcorrencia" => $idOcorrencia,
			":idVitima" => $idVitima
		]);
	}

}

?>