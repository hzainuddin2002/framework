<?php
namespace dao;

class UserDao extends \dao\DaoMain
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUserById($id)
	{
		$qry = 'SELECT * FROM test_schema.users as u WHERE u.id = "' . $id . '"';

		$results = parent::executeQuery($qry);
		return $results;
	}

	public function getUserByName($name)
	{
		$qry = 'SELECT * FROM test_schema.users as u WHERE u.first_name = "' . $name . '"';

		$results = parent::executeQuery($qry);
		return $results;
	}

	public function getAllUsers()
	{
		$qry = 'SELECT * FROM test_schema.users;';

		$results = parent::executeQuery($qry);
		return $results;
	}

	public function createNewUser($fName, $lName, $dob, $phone)
	{
		$qry = "INSERT INTO test_schema.users (first_name, last_name, dob, phone_num) VALUES ('" . $fName . "', '" . $lName . "', '" . $dob . "', '" . $phone . "');";

		$results = parent::executeQuery($qry);
	}
}