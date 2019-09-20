<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Apuracao;
use \App\Classe\Validacao;

class MApuracao {

	public function cadastrar($post, $idUsuario)
	{
		$sql = new Conexao;

		$apuracao = new Apuracao;
		$validacao = new Validacao;

		$apuracao->setData($post);

		//Status
		//1 = criada esperando para continuar
		//2 = gerada ocorrencia, foi para confirmacao
		//3 = virou ocorrencia
		//4 = excluida

		$sql->query("
			INSERT INTO tb_criarapuracao (idUsuario, tipoApuracao, descricao, status) 
			VALUES(:idUsuario, :tipoApuracao, :descricao, :status)
		", [
			":idUsuario" => $idUsuario,
			":tipoApuracao" => utf8_decode($apuracao->gettipoApuracao()),
			":descricao" => utf8_decode($apuracao->getdescricaoApuracao()),
			":status" => 1
		]);
	}

	//Lista tudo da tabela
	public function listAll()
	{
		$sql = new Conexao;

		return $sql->select("SELECT * FROM tb_criarapuracao");
	}

	public function ultimoRegistro()
	{

		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idCriarApuracao) FROM tb_criarapuracao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Mudar o status da apuracao
	public function updateStatus($status, $idApuracao)
	{
		$sql = new Conexao;

		//Status
		//1 = criada esperando para continuar
		//2 = gerada ocorrencia, foi para confirmacao
		//3 = virou ocorrencia
		//4 = excluida

		$sql->query("
			UPDATE tb_criarapuracao 
			SET status = :status
			WHERE idCriarApuracao = :idCriarApuracao
		", [
			":status" => $status,
			":idCriarApuracao" => $idApuracao
		]);
	}

	//Inserir na tabela excluir apuracao
	public function apuracaoExcluida($post, $idApuracao, $idUsuario)
	{
		$sql = new Conexao;

		$apuracao = new Apuracao;

		$apuracao->setData($post);

		$sql->query("
			INSERT INTO tb_apuracaoexcluida (idCriarApuracao, idUsuario, motivo) 
			VALUES(:idCriarApuracao, :idUsuario, :motivo)
		", [
			":idCriarApuracao" => $idApuracao,
			":idUsuario" => $idUsuario,
			":motivo" => utf8_decode($apuracao->getdescricaoApuracao())
		]);
	}

	//----------------------------------------------------------------
	//CADASTRAR NA TABELA VitimasCriarApuracao 
	//----------------------------------------------------------------
	public function cadastrarVitimasCriarApuracao($idVitima, $idApuracao)
	{
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_vitimascriarapuracao (idVitimasApuracao, idCriarApuracao) 
			VALUES(:idVitimasApuracao, :idCriarApuracao)
		", [
			":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"],
			":idCriarApuracao" => (int)$idApuracao[0]["MAX(idCriarApuracao)"]
		]);
	}

	//----------------------------------------------------------------
	//CADASTRAR NA TABELA FamiliaApuracao
	//----------------------------------------------------------------
	public function cadastrarFamiliaApuracao($post, $idApuracao, $idVitima, $idResponsavel)
	{
		$sql = new Conexao;

		$apuracao = new Apuracao;

		$apuracao->setData($post);

		$sql->query("
			INSERT INTO tb_familiaapuracao (idCriarApuracao, idVitimasApuracao, idResponsavelApuracao, qualFamilia) 
			VALUES(:idCriarApuracao, :idVitimasApuracao, :idResponsavelApuracao, :qualFamilia)
		", [
			":idCriarApuracao" => (int)$idApuracao[0]["MAX(idCriarApuracao)"],
			":idVitimasApuracao" => (int)$idVitima[0]["MAX(idVitimasApuracao)"],
			":idResponsavelApuracao" => (int)$idResponsavel[0]["MAX(idResponsavelApuracao)"],
			":qualFamilia" => utf8_decode($apuracao->getqualFamiliaVitima())
		]);	
	}

	//Listar todos os dados da apuracao como pessoas envolvidas, endereco, contato, dados da apuracao
	public function listApuracao($idApuracao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idCriarApuracao, a.idUsuario, a.tipoApuracao, a.descricao, a.status, a.dataRegistro,
			b.idVitimasCriarApuracao, b.idVitimasApuracao,
			c.idPessoa, c.idResponsavelApuracao,
			d.qualFamilia, e.idPessoa idPessoaResponsavel,
			f.nome nomeVitima, f.sexo sexoVitima, f.cpf cpfVitima,
			g.nome nomeResponsavel, g.cpf cpfResponsavel,
			h.celular celularVitima,
			i.celular celularResponsavel,
			j.cep cepVitima, j.rua ruaVitima, j.numero numeroVitima, j.bairro bairroVitima, 
			j.cidade cidadeVitima, j.estado estadoVitima, j.complemento complementoVitima,
			k.cep cepResponsavel, k.rua ruaResponsavel, k.numero numeroResponsavel, k.bairro bairroResponsavel, 
			k.cidade cidadeResponsavel, k.estado estadoResponsavel, k.complemento complementoResponsavel
			FROM tb_criarapuracao a
			INNER JOIN tb_vitimascriarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimasapuracao c ON b.idVitimasApuracao = c.idVitimasApuracao
			INNER JOIN tb_familiaapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao e ON c.idResponsavelApuracao = e.idResponsavelApuracao
			INNER JOIN tb_pessoa f ON c.idPessoa = f.idPessoa
			INNER JOIN tb_pessoa g ON e.idPessoa = g.idPessoa
			INNER JOIN tb_contato h ON f.idContato = h.idContato
			INNER JOIN tb_contato i ON g.idContato = i.idContato
			INNER JOIN tb_endereco j ON f.idEndereco = j.idEndereco
			INNER JOIN tb_endereco k ON g.idEndereco = k.idEndereco
			WHERE a.idCriarApuracao = :idCriarApuracao;
		", [
			":idCriarApuracao" => $idApuracao
		]);
	}

	//Listar todos os dados da apuracao como pessoas envolvidas, endereco, contato, dados da apuracao
	public function listApuracaoCompleta()
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idCriarApuracao, a.idUsuario, a.tipoApuracao, a.descricao, a.status, a.dataRegistro,
			b.idVitimasCriarApuracao, b.idVitimasApuracao,
			c.idPessoa, c.idResponsavelApuracao,
			d.qualFamilia, e.idPessoa idPessoaResponsavel,
			f.nome nomeVitima, f.sexo sexoVitima, f.cpf cpfVitima,
			g.nome nomeResponsavel, g.cpf cpfResponsavel,
			h.celular celularVitima,
			i.celular celularResponsavel,
			j.cep cepVitima, j.rua ruaVitima, j.numero numeroVitima, j.bairro bairroVitima, 
			j.cidade cidadeVitima, j.estado estadoVitima, j.complemento complementoVitima,
			k.cep cepResponsavel, k.rua ruaResponsavel, k.numero numeroResponsavel, k.bairro bairroResponsavel, 
			k.cidade cidadeResponsavel, k.estado estadoResponsavel, k.complemento complementoResponsavel
			FROM tb_criarapuracao a
			INNER JOIN tb_vitimascriarapuracao b ON a.idCriarApuracao = b.idCriarApuracao
			INNER JOIN tb_vitimasapuracao c ON b.idVitimasApuracao = c.idVitimasApuracao
			INNER JOIN tb_familiaapuracao d ON c.idVitimasApuracao = d.idVitimasApuracao
			INNER JOIN tb_responsavelapuracao e ON c.idResponsavelApuracao = e.idResponsavelApuracao
			INNER JOIN tb_pessoa f ON c.idPessoa = f.idPessoa
			INNER JOIN tb_pessoa g ON e.idPessoa = g.idPessoa
			INNER JOIN tb_contato h ON f.idContato = h.idContato
			INNER JOIN tb_contato i ON g.idContato = i.idContato
			INNER JOIN tb_endereco j ON f.idEndereco = j.idEndereco
			INNER JOIN tb_endereco k ON g.idEndereco = k.idEndereco
		");
	}

}

?>