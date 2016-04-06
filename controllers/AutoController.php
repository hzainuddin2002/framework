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

		// Get DB data on autos
		$autoDataArr = $this->autoDao->getAutoByMake($make);
		
		// Close the SQL connection
		$this->autoDao->closeConnection();

		// turn data into model
		$autoModelArr = $this->createAutoModelFromData($autoDataArr);

		return $autoModelArr;
	}

	private function createAutoModelFromData($autoDataArr)
	{
		$resArr = array();
		for ($i = 0; $i < sizeof($autoDataArr); $i++) {
			$tempAutoMod = new \models\AutoModel(
				$autoDataArr[$i]['id'],
				$autoDataArr[$i]['type'],
				$autoDataArr[$i]['number_of_wheels'],
				$autoDataArr[$i]['color'],
				$autoDataArr[$i]['make'],
				$autoDataArr[$i]['model']
			);

			$resArr[] = $tempAutoMod;
		}

		return $resArr;
	}
}
?>