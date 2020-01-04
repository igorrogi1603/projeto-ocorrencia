<?php

namespace App\Config;

use \Rain\Tpl;

//Não faz parte da arquitetura padrao
//apenas para poder passar informacao para o header
use \App\Controller\CHeader;

class Page {
	
	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = "/App/Views/site/")
	{	
		$this->options = array_merge($this->defaults, $opts);
		
		$config = array(
			"tpl_dir"	=> $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"	=> $_SERVER["DOCUMENT_ROOT"]."/App/Views-cache/",
			"debug"		=> false
		);
		
		Tpl::configure( $config );
		
		$this->tpl = new Tpl;
		
		$this->setData($this->options["data"]);
		
		//Na forma original do arquivo nao tem a ultima linha da session apenas ate o HEADER
		//O segundo parametro e o unico jeito de mandar uma variavel para o header

		if ($this->options["header"] === true) {

			if (isset($_SESSION['User']['status']) && $_SESSION['User']['status'] == 1) {
				$nomeUsuario = $_SESSION['User']['subnome'];
			} else {
				$nomeUsuario = $_SESSION['User']['nome'];
			}

			$this->setTpl("header", [
				'user' => $nomeUsuario,
				'notificacao' => CHeader::getNotificacao(),
				'nivelAcesso' => $_SESSION['User']['nivelAcesso'],
				'idUser' => $_SESSION['User']['idUsuario']
			]);
		}
	}

	public function setData($data = array())
	{
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}

	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{
		$this->setData($data);

		return $this->tpl->draw($tplname, $returnHTML);
	}
	
	public function __destruct()
	{		
		if ($this->options["header"] === true) $this->tpl->draw("footer");
	}
}
?>