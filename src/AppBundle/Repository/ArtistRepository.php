<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Record;

class ArtistRepository extends EntityRepository
{
	public function findFullOneById($id)
	{
		$query = $this->getEntityManager()
		->createQuery(
			'SELECT a, r FROM AppBundle:Artist a
        	JOIN a.records r
       		WHERE a.id = :id'
		)->setParameter('id', $id);
		
		try {
			return $query->getOneOrNullResult();
		} catch (\Doctrine\ORM\NoResultException $e) {
			throw $e;
		}
	}
	
	public function save($id, $data) {
		try {
			$em = $this->getEntityManager();
			$artist = $this->find($id);
			$artist->setName($data['name']);
			$artist->setBirthDate($data['birthdate']);

			foreach($data['records'] as $idRecord) {
				$record = $em->getRepository(Record::class)->find($idRecord);
				if (!$artist->getRecords()->contains($record)) {
					$artist->addRecord($record);
				}
			}
			
			$em->flush();
			
			return $id;
		} catch (\Doctrine\ORM\ORMException $e) {
			throw $e;
		}
	}
}