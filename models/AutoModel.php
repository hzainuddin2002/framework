<?php
namespace models;

class AutoModel
{
	private $id;
	private $type;
	private $numberOfWheels;
	private $color;
	private $make;
	private $model;

	function __construct($id = null, $type = null, $numWhls = null, $color = null, $make = null, $model = null)
	{
		$this->id = (isset($id)) ? $id : 0;
		$this->type = (isset($type)) ? $type : '';
		$this->numberOfWheels = (isset($numWhls)) ? $numWhls : 0;
		$this->color = (isset($color)) ? $color : 0;
		$this->make = (isset($make)) ? $make : '';
		$this->model = (isset($model)) ? $model : '';
	}

	public function getId()
	{
		return $this->id;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getNumberOfWheels()
	{
		return $this->numberOfWheels;
	}

	public function getColor()
	{
		return $this->color;
	}

	public function getMake()
	{
		return $this->make;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function getAsArray()
	{
		$autoArr = array();
		$autoArr['id'] = $this->getId();
		$autoArr['type'] = $this->getType();
		$autoArr['numOfWheels'] = $this->getNumberOfWheels();
		$autoArr['color'] = $this->getColor();
		$autoArr['make'] = $this->getMake();
		$autoArr['model'] = $this->getModel();

		return $autoArr;
	}
}
?>