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
		try {
			$e = $this->em->getRepository($entityFullName)->findFullOneById($id);
		}
		catch(\Exception $e) {
			$this->logger->error($e->getFile() . ', linea ' . $e->getLine() . ', ' . $e->getMessage());
			throw new \Exception('errors.record_not_found');
		}
		return $e;
	}
	
	public function getCollection($entityFullName, $search = array()) {
		if (empty($search)) {
			return $this->em->getRepository($entityFullName)->findAll();
		} else {
			
		}
	}
	
	public function saveEntity($entityFullName, $id, $data) {
		try {
			$e = $this->em->getRepository($entityFullName)->save($id, $data);
		}
		catch(\Exception $e) {
			$this->logger->error($e->getFile() . ', linea ' . $e->getLine() . ', ' . $e->getMessage());
			throw new \Exception('errors.record_not_saved');
		}
		return $e;
	}
}