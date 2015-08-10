<?php
namespace BishBashBoshBundle\Model;
use BishBashBoshBundle\Model\AbstractFamilyModel;

class CatFamilyModel extends AbstractFamilyModel
{
	protected $name = 'cat';
	protected $attackType = 'claw';
	protected $damage = 2;
}