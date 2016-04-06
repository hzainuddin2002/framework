<?php
namespace helpers;

class AppConfigHelper
{
	private $configs;

	function __construct()
	{
		$this->configs = require __DIR__ . '/../configs/config.php';
	}

	public function getHost()
	{
		return $this->configs['host'];
	}

	public function getUserName()
	{
		return $this->configs['username'];
	}

	public function getPassword()
	{
		return $this->configs['password'];
	}

	public function getDataBase()
	{
		return $this->configs['database'];
	}
}
?>