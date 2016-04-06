<?php
namespace controllers;

class AutoController
{
	private $autoDao;

	function __construct()
	{
		$this->autoDao = new \dao\AutomobileDao();
	}

	public function getAutoByMake($make)
	{
		if (!isset($make)) {
			return new \models\AutoModel();
		}

		$autoData = $this->autoDao->getAutoByMake($make);
		
		// Close the SQL connection
		$this->autoDao->closeConnection();

		// turn data into model
		$resArr = array();
		for ($i = 0; $i < sizeof($autoData); $i++) {
			$tempAutoMod = new \models\AutoModel(
				$autoData[$i]['id'],
				$autoData[$i]['type'],
				$autoData[$i]['number_of_wheels'],
				$autoData[$i]['color'],
				$autoData[$i]['make'],
				$autoData[$i]['model']
			);

			$resArr[] = $tempAutoMod;
		}

		return $resArr;
		
	}
}
?>