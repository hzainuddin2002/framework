<?php
namespace dao;

class DaoMain
{
	private $config;
	protected $conn;

	function __construct()
	{	
		// Pull in the configs
		$this->config = new \helpers\AppConfigHelper();

		// Make a connection
		$this->conn = $this->setConnection();
	}

	private function setConnection()
	{
		$conn = mysqli_connect(
			$this->config->host,
			$this->config->username,
			$this->config->password,
			$this->config->database
		);

		if (mysqli_connect_errno()) {
			echo "Unable to connect to MySQL: " . mysqli_connect_error();
		    die();
		}

		return $conn;	
	}

	protected function executeQuery($qry)
	{
		$results = mysqli_query($this->conn, $qry) or exit("MySQL Error");

		$dataArr = array();
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
			$dataArr[] = $row;
		}

		if (!$dataArr) {
			return array();
		}

		return $dataArr;
	}

	public function closeConnection()
	{
		mysqli_close($this->conn);
	}
}


?>