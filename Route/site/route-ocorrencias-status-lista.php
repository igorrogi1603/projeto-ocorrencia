<?php 

use \App\Config\Page;
use \App\Classe\Usuario;
use \App\Classe\Validacao;
use \App\Controller\CListaOcorrencia;

//QUATRO FASES DA OCORRENCIA
$app->get("/ocorrencias-abertas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaOcorrencia);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaOcorrencia[$i])) {
					//se existe guarda em id
					$id = $listaOcorrencia[$i]['idCriarApuracao'];
				}
				
				//Compara com outro array
				for ($a = 0; $a < $tamanhoArrayUsuario; $a++) {
					//Se os id forem iguais entao exclui para nao duplicar
					if ($id == $listaBloquearOcorrenciaUsuario[$a]['idCriarApuracao']) {
						$arrayPosicaoExcluir[] = $i;
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($listaOcorrencia[$value]);
				}
			}

			$listaFinal = $listaOcorrencia;
		} else {
			$listaFinal = $listaOcorrencia;
		}

		$page = new Page();

		$page->setTpl("ocorrencias-abertas", [
			"listaOcorrencia" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-reabertas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaOcorrencia);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaOcorrencia[$i])) {
					//se existe guarda em id
					$id = $listaOcorrencia[$i]['idCriarApuracao'];
				}
				
				//Compara com outro array
				for ($a = 0; $a < $tamanhoArrayUsuario; $a++) {
					//Se os id forem iguais entao exclui para nao duplicar
					if ($id == $listaBloquearOcorrenciaUsuario[$a]['idCriarApuracao']) {
						$arrayPosicaoExcluir[] = $i;
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($listaOcorrencia[$value]);
				}
			}

			$listaFinal = $listaOcorrencia;
		} else {
			$listaFinal = $listaOcorrencia;
		}

		$page = new Page();

		$page->setTpl("ocorrencias-reabertas", [
			"listaOcorrencia" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-arquivadas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaOcorrencia);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaOcorrencia[$i])) {
					//se existe guarda em id
					$id = $listaOcorrencia[$i]['idCriarApuracao'];
				}
				
				//Compara com outro array
				for ($a = 0; $a < $tamanhoArrayUsuario; $a++) {
					//Se os id forem iguais entao exclui para nao duplicar
					if ($id == $listaBloquearOcorrenciaUsuario[$a]['idCriarApuracao']) {
						$arrayPosicaoExcluir[] = $i;
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($listaOcorrencia[$value]);
				}
			}

			$listaFinal = $listaOcorrencia;
		} else {
			$listaFinal = $listaOcorrencia;
		}

		$page = new Page();

		$page->setTpl("ocorrencias-arquivadas", [
			"listaOcorrencia" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

$app->get("/ocorrencias-encerradas", function(){

	Usuario::verifyLogin();

	if ($_SESSION['User']['nivelAcesso'] == "4" ||
		$_SESSION['User']['nivelAcesso'] == "2210" ||
		$_SESSION['User']['nivelAcesso'] == "3748"
	) {
		$listaOcorrencia = CListaOcorrencia::getListaOcorrencia();
		$listaBloquearOcorrenciaUsuario = CListaOcorrencia::listaBloquearOcorrenciaUsuario($_SESSION['User']['idUsuario']);

		if (isset($listaBloquearOcorrenciaUsuario) && $listaBloquearOcorrenciaUsuario != null && $listaBloquearOcorrenciaUsuario != "") {
			//Pega o tamanho do arry para usar no for
			$tamanhoArray = count($listaOcorrencia);
			$tamanhoArrayUsuario = count($listaBloquearOcorrenciaUsuario);

			for ($i = 0; $i < $tamanhoArray; $i++) {
				//Verifica sea posicao que queremos guardar existe
				if (isset($listaOcorrencia[$i])) {
					//se existe guarda em id
					$id = $listaOcorrencia[$i]['idCriarApuracao'];
				}
				
				//Compara com outro array
				for ($a = 0; $a < $tamanhoArrayUsuario; $a++) {
					//Se os id forem iguais entao exclui para nao duplicar
					if ($id == $listaBloquearOcorrenciaUsuario[$a]['idCriarApuracao']) {
						$arrayPosicaoExcluir[] = $i;
					}
				}
			}

			if (isset($arrayPosicaoExcluir)) {
				//exclui posissoes iguais
				foreach ($arrayPosicaoExcluir as $value) {
					unset($listaOcorrencia[$value]);
				}
			}

			$listaFinal = $listaOcorrencia;
		} else {
			$listaFinal = $listaOcorrencia;
		}

		$page = new Page();

		$page->setTpl("ocorrencias-encerradas", [
			"listaOcorrencia" => $listaFinal
		]);
	} else {
		$page = new Page([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("404");
	}
});

?>