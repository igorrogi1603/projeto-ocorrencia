<?php

namespace App\Config;

use \Rain\Tpl;

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
		
		if ($this->options["header"] === true) $this->tpl->draw("header");
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