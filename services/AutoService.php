<?php
namespace services;

/**
 * Automobile Controller
 */
class AutoService
{
	/**
	 * AutomobileDao $auto Allows access to the DB
	 */
	private $autoDao;

	function __construct()
	{
		$this->autoDao = new \dao\AutomobileDao();
	}

	/**
	 * Get Automobile data by make
	 *
	 * @param string $make Make of automobile
	 *
	 * @return array $autoModelArr Array of AutoModel objects
	 */
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

	/**
	 * Takes DB data as array and creates an array of AutoModel objects
	 *
	 * @param array $autoDataArr Array of automobile DB data
	 *
	 * @return array $resArr Array of AutoModel objects
	 */
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