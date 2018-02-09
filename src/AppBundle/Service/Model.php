<?php 
namespace AppBundle\Service;

use AppBundle\Entity;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class Model {
	private $logger;
	private $em;
	
	public function __construct(LoggerInterface $logger, EntityManagerInterface $em)
	{
		$this->logger = $logger;
		$this->em = $em;
	}
	
	public function getEntity($entityFullName) {
		return $this->em->getRepository($entityFullName)->findAll();
	}
	
	public function getCollection($entityFullName) {
		return $this->em->getRepository($entityFullName)->findAll();
	}
}