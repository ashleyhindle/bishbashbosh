<?php
namespace BishBashBoshBundle\Model\Animals;

use BishBashBoshBundle\Model\Animals\AbstractAnimal;

class Dog extends AbstractAnimal
{
	protected $size = 1;

	public function __construct()
	{
		parent::__construct();
		$this->family = new \BishBashBoshBundle\Model\DogFamilyModel();
		$parts = explode('\\', __CLASS__);
		$this->name = end($parts);
	}
}