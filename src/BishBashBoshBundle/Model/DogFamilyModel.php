<?php
namespace BishBashBoshBundle\Model;
use \BishBashBoshBundle\Model\AbstractFamilyModel;

class DogFamilyModel extends AbstractFamilyModel
{
	protected $name = 'dog';
	protected $attackType = 'bite';
	protected $damage = 2;
}