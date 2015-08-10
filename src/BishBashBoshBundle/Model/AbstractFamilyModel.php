<?php
namespace BishBashBoshBundle\Model;

abstract class AbstractFamilyModel
{
	public function getDamagePoints()
	{
		return $this->damage;
	}

	public function getName()
	{
		return $this->name;
	}
}