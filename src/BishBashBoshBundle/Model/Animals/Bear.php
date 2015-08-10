<?php
namespace BishBashBoshBundle\Model\Animals;

use BishBashBoshBundle\Model\Animals\AbstractAnimal;

class Bear extends AbstractAnimal
{
	protected $size = 3;

	public function __construct()
	{
		parent::__construct();
		$this->family = new \BishBashBoshBundle\Model\BearFamilyModel();
		$parts = explode('\\', __CLASS__);
		$this->name = end($parts);
	}
}