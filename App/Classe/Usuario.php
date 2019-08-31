<?php

namespace App\Classe;

use \App\Config\GetSet;

class Usuario extends GetSet {

	public static function getPasswordHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}

}

?>