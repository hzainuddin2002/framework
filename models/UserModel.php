<?php
namespace models;

/**
 *	Model for User Data from the DB
 */
class UserModel
{
	private $id;
	private $firstName;
	private $lastName;
	private $dob;
	private $phone;

	function __construct($id = null, $fname = null, $lname = null, $dob = null, $phone = null)
	{
		$this->id = (isset($id)) ? $id : 0;
		$this->firstName = (isset($fname)) ? $fname : '';
		$this->lastName = (isset($lname)) ? $lname : '';
		$this->dob = (isset($dob)) ? $dob : '00/00/00';
		$this->phone = (isset($phone)) ? $phone : '0000000000';
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getDob()
	{
		return $this->dob;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getAsArray()
	{
		$userArr = array();
		$userArr['id'] = $this->getId();
		$userArr['firstName'] = $this->getFirstName();
		$userArr['lastName'] = $this->getLastName();
		$userArr['dob'] = $this->getDob();
		$userArr['phone'] = $this->getPhone();

		return $userArr;
	}
}

?>