<?php
namespace BishBashBoshBundle\Model\Animals;

use BishBashBoshBundle\Model\Animals\AbstractAnimal;

class Bobcat extends AbstractAnimal
{
	protected $size = 1;

	public function __construct()
	{
		parent::__construct();
		$this->family = new \BishBashBoshBundle\Model\CatFamilyModel();
		$parts = explode('\\', __CLASS__);
		$this->name = end($parts);
	}
}