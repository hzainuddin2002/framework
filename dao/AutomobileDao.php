<?php
namespace dao;

class AutomobileDao extends \dao\DaoMain
{
	function __construct()
	{
		parent::__construct();
	}

	public function getAutoByMake($make)
	{
		$qry = 'SELECT * FROM test_schema.automobiles AS a WHERE a.make = "' . $make . '";';

		$results = parent::executeQuery($qry);

		return $results;
	}
}

?>