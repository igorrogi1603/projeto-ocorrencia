<?php

namespace App\Model;

use \App\Config\Conexao;
use \App\Classe\Solicitacao;
use \App\Classe\Validacao;

class MSolicitacao {

	//Cadastrar na tabela Remetente
	public function cadastrarRemetente($idOcorrencia)
	{	
		$sql = new Conexao;

		$sql->query("
			INSERT INTO tb_remetente (idOcorrencia) 
			VALUES(:idOcorrencia)
		", [
			":idOcorrencia" => (int)$idOcorrencia
		]);
	}

	//Cadastrar na tabela Destinatario
	public function cadastrarDestinatario($post)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_destinatario (idUsuario) 
			VALUES(:idUsuario)
		", [
			":idUsuario" => (int)$solicitacao->getpara()
		]);
	}

	//Cadastrar na tabela Solicitacao
	public function cadastrarSolicitacao($post, $idOcorrencia, $idRemetente, $idDestinatario)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_solicitacao (idOcorrencia, idRemetente, idDestinatario, assunto, mensagem, dataCriacao, isResposta, isLixeira)
			VALUES(:idOcorrencia, :idRemetente, :idDestinatario, :assunto, :mensagem, :dataCriacao, :isResposta, :isLixeira)
		", [
			":idOcorrencia" => (int)$idOcorrencia,
			":idRemetente" => (int)$idRemetente,
			":idDestinatario" => (int)$idDestinatario,
			":assunto" => $solicitacao->getassunto(),
			":mensagem" => $solicitacao->getmensagem(),
			":dataCriacao" => date("Y-m-d H:i:s"),
			":isResposta" => 0,
			":isLixeira" => 0
		]);
	}

	//Cadastrar na tabela Resposta
	public function cadastrarResposta($post, $idSolicitacao)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_resposta (idSolicitacao, resposta) 
			VALUES(:idSolicitacao, :resposta)
		", [
			":idSolicitacao" => (int)$idSolicitacao,
			":resposta" => $solicitacao->getmensagem()
		]);
	}

	//Cadastrar na tabela SolicitacaoVitimas
	public function cadastrarSolicitacaoVitimas($idSolicitacao, $post)
	{	
		$sql = new Conexao;
		$solicitacao = new Solicitacao;

		$solicitacao->setData($post);

		$sql->query("
			INSERT INTO tb_solicitacaovitimas (idSolicitacao, idVitimasApuracao) 
			VALUES(:idSolicitacao, :idVitimasApuracao)
		", [
			":idSolicitacao" => (int)$idSolicitacao,
			":idVitimasApuracao" => (int)$solicitacao->getvitima()
		]);
	}

	//Ultimo registro Remetente
	public function ultimoRegistroRemetente()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idRemetente) FROM tb_remetente");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Destinatario
	public function ultimoRegistroDestinatario()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idDestinatario) FROM tb_destinatario");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Solicitacao
	public function ultimoRegistroSolicitacao()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idSolicitacao) FROM tb_solicitacao");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Ultimo registro Resposta
	public function ultimoRegistroResposta()
	{
		$sql = new Conexao;

		$qtd = $sql->select("SELECT MAX(idResposta) FROM tb_resposta");

		if ($qtd != null) {

			return $qtd;

		} else {
			return false;
		}
	}

	//Alterar valor da solicitacao IsLixeira
	public function alterarIsLixeira($idSolicitacao)
	{
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_solicitacao
			SET isLixeira = :isLixeira
			WHERE idSolicitacao = :idSolicitacao
		", [
			":isLixeira" => 1,
			":idSolicitacao" => $idSolicitacao
		]);
	}

	//Alterar isResposta da solicitacao
	public function alterarIsResposta($idSolicitacao)
	{
		$sql = new Conexao;

		$sql->query("
			UPDATE tb_solicitacao
			SET isResposta = :isResposta
			WHERE idSolicitacao = :idSolicitacao
		", [
			":isResposta" => 1,
			":idSolicitacao" => $idSolicitacao
		]);
	}

	public function listaSolicitacaoResposta($idSolicitacao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT *
			FROM tb_resposta
			WHERE idSolicitacao = :idSolicitacao
		", [
			":idSolicitacao" => $idSolicitacao
		]);
	}

	//FAZER DOIS SELECT UM PARA USUARIO PESSOA FISICA E OUTRO PARA USUARIO INSTITUICAO
	//Lista de Solicitacao Pessoa Fisica
	public function listaOcorrenciaSolicitacao($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cpf cpfDestinatario, e.rg rgDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_pessoa e ON d.idPessoa = e.idPessoa
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE a.idOcorrencia = :idOcorrencia
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

	//Lista de Solicitacao Instituicao
	public function listaOcorrenciaSolicitacaoInstituicao($idOcorrencia)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cnpj cnpjDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_instituicao e ON d.idInstituicao = e.idInstituicao
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE a.idOcorrencia = :idOcorrencia
		", [
			":idOcorrencia" => $idOcorrencia
		]);
	}

	//Select Solicitacao Especifica Pessoa
	public function listaOcorrenciaSolicitacaoPessoa($idSolicitacao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cpf cpfDestinatario, e.rg rgDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_pessoa e ON d.idPessoa = e.idPessoa
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE a.idSolicitacao = :idSolicitacao
		", [
			":idSolicitacao" => $idSolicitacao
		]);
	}

	//Select Solicitacao Especifica Instituicao
	public function solicitacaoEspecificaInstituicao($idSolicitacao)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cnpj cnpjDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_instituicao e ON d.idInstituicao = e.idInstituicao
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE a.idSolicitacao = :idSolicitacao
		", [
			":idSolicitacao" => $idSolicitacao
		]);	
	}

	//Solicitacao Usuario Nivel 2
	//Lista Pessoa fisica
	public function listaSolicitacao($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cpf cpfDestinatario, e.rg rgDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_pessoa e ON d.idPessoa = e.idPessoa
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE c.idUsuario = :idUsuario
		", [
			":idUsuario" => $idUsuario
		]);
	}

	//Lista de Solicitacao Instituicao
	public function listaSolicitacaoInstituicao($idUsuario)
	{
		$sql = new Conexao;

		return $sql->select("
			SELECT 
			a.idSolicitacao, a.idOcorrencia, a.idRemetente, a.idDestinatario, a.assunto, 
			a.mensagem, a.dataCriacao, a.isResposta, a.isLixeira,
			b.idVitimasApuracao,
			c.idUsuario idUsuarioDestinatario,
			d.funcao funcaoDestinatario, d.setor setorDestinatario,
			e.nome nomeDestinatario, e.cnpj cnpjDestinatario,
			g.nome nomeVitima, g.cpf cpfVitima, g.rg rgVitima 
			FROM tb_solicitacao a
			INNER JOIN tb_solicitacaovitimas b ON a.idSolicitacao = b.idSolicitacao
			INNER JOIN tb_destinatario c ON a.idDestinatario = c.idDestinatario
			INNER JOIN tb_usuario d ON c.idUsuario = d.idUsuario
			INNER JOIN tb_instituicao e ON d.idInstituicao = e.idInstituicao
			INNER JOIN tb_vitimasApuracao f ON b.idVitimasApuracao = f.idVitimasApuracao
			INNER JOIN tb_pessoa g ON f.idPessoa = g.idPessoa
			WHERE c.idUsuario = :idUsuario
		", [
			":idUsuario" => $idUsuario
		]);
	}

}

?>