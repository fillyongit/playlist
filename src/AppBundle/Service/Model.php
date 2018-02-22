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
		$e = $this->em->getRepository($entityFullName)->findFullOneById($id);
		if (!$e) {
			throw new \Exception('errors.record_not_found');
		}
		return $e;
	}
	
	public function getCollection($entityFullName) {
		return $this->em->getRepository($entityFullName)->findAll();
	}
	
	public function saveEntity($entityFullName, $id, $data) {
		die(var_dump($data));
		$e = $this->em->getRepository($entityFullName)->save($id, $data);
		if (!$e) {
			throw new \Exception('errors.record_not_saved');
		}
		return $e;
	}
}