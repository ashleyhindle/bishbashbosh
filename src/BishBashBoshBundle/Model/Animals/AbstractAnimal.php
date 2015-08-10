<?php
namespace BishBashBoshBundle\Model\Animals;

abstract class AbstractAnimal
{
	protected $hp = 0;
	protected $size = 0;
	protected $family;
	protected $name;

	public function __construct() {
		$this->hp = rand(10, 20);
	}

	public function attack(\BishBashBoshBundle\Model\Animals\AbstractAnimal $animal)
	{
		$animal->reduceHp($this->getDamagePoints());
		return $animal;
	}

	public function getDamagePoints()
	{
		return $this->getSize() * $this->family->getDamagePoints();
	}

	public function isAlive()
	{
		return ($this->getHp() > 0);
	}

	public function reduceHp($hp)
	{
		$this->hp -= $hp;
		return $this->hp;
	}

	public function getSize()
	{
		return $this->size;
	}

	public function getHp()
	{
		return $this->hp;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getFamily()
	{
		return $this->family;
	}
}