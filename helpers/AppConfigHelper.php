<?php
namespace helpers;

/**
 * Turns the config file into an object
 *
 * Uses config file at /../configs/config.php.
 */
class AppConfigHelper
{
	/** array $configs Set to the config array from file */
	private $configs;

	function __construct()
	{
		$this->configs = require __DIR__ . '/../configs/config.php';
	}

	/**
	 * Magic getter method
	 *
	 * Allows the config array to be private, so they can't be
	 * overwritten, but allows access to values.
	 */
	public function __get($key)
	{
		if (isset($this->configs[$key])) {
			return $this->configs[$key];
		}
		elseif (isset($this->$key)) {
			return $this->$key;
		}
	}
}
?>