<?php
namespace controllers;

class UserController
{
	private $userDao;
	private $userModel;

	function __construct()
	{
		$this->userDao = new \dao\UserDao();
	}

	public function getUserDataById($id)
	{
		if (!isset($id)) {
			return new \models\UserModel();
		}

		// Get the user data using the post ID
		$userDataArr = $this->userDao->getUserById($id);

		// Close the SQL connection
		$this->userDao->closeConnection();

		// Instantiate a user Model
		$userModelArr = $this->createUserModelFromData($userDataArr);

		return $userModelArr;
	}

	public function getUserDataByName($name)
	{
		if (!isset($name)) {
			return new \models\UserModel();
		}

		// Get the user data from the DB
		$userDataArr = $this->userDao->getUserByName($name);

		// Close the SQL connection
		$this->userDao->closeConnection();

		// Get an array of instantiated User Models
		$userModelArr = $this->createUserModelFromData($userDataArr);		
		
		return $userModelArr;
	}

	public function getAllUsers()
	{
		// Get all the users from DB
		$userDataArr = $this->userDao->getAllUsers();

		// Close SQL connection
		$this->userDao->closeConnection();

		// Get an array of User objs
		$userModelArr = $this->createUserModelFromData($userDataArr);

		return $userModelArr;
	}

	public function createNewUser($fName, $lName, $dob, $phone)
	{
		// Instantiate the User Dao
		$userDao = new \dao\UserDao();

		// Call the Create new user function
		$userDao->createNewUser($fName, $lName, $dob, $phone);
	}

	private function createUserModelFromData($userDataArr)
	{
		$userModelArr = array();
		for ($i = 0; $i < sizeof($userDataArr); $i++) {
			// Create a Temporary User Obj
			$tempUser = new \models\UserModel(
				$userDataArr[$i]['id'],
				$userDataArr[$i]['first_name'],
				$userDataArr[$i]['last_name'],
				$userDataArr[$i]['dob'],
				$userDataArr[$i]['phone_num']
			);

			$userModelArr[] = $tempUser;
		}

		return $userModelArr;
	}
}

?>