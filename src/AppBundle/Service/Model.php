<?php 
namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineBundle;

class Model {
	public function getDoctrineRepository($objectName, DoctrineBundle $doctrine) {
		return $doctrine->getRepository($persistentObjectName);
	}
}