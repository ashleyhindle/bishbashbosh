<?php
namespace BishBashBoshBundle\Model;

class Bobcat extends AbstractAnimal
{
	protected $size = 1;

	public function __construct()
	{
		//TODO: Better way of managing HP so forgetting parent construct doesn't give the animal 0 health
		//TODO: What is the best way of setting the family and size?
		parent::__construct();
		$this->family = new \BishBashBoshBundle\Model\CatFamilyModel();
	}
}

$bobcat = new Bobcat();
echo $bobcat->getHp() . PHP_EOL;
echo $bobcat->getDamagePoints() . PHP_EOL;