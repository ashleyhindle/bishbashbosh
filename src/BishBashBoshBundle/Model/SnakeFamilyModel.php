<?php
namespace BishBashBoshBundle\Model;
use \BishBashBoshBundle\Model\AbstractFamilyModel;

class SnakeFamilyModel extends AbstractFamilyModel
{
	protected $name = 'snake';
	protected $attackType = 'poison';
	protected $damage = 4;
}