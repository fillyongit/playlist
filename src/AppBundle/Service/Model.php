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
	
	public function getEntity($entityFullName, $id) {
		$e = $this->em->getRepository($entityFullName)->find($id);
		if (!$e) {
			throw new \Exception('record_not_found');
		}
	}
	
	public function getCollection($entityFullName) {
		return $this->em->getRepository($entityFullName)->findAll();
	}
}