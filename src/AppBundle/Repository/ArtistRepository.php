<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Record;

class ArtistRepository extends PlEntityRepository
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::findFullOneById()
	 */
	public function findFullOneById($id) {
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
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::save()
	 */
	public function save($id, array $data) {
		try {
			$em = $this->getEntityManager();
			$artist = $this->find($id);
			$artist->setName($data['name']);
			$artist->setBirthDate($data['birthdate']);
			
			$artist->getRecords()->clear();
			
			foreach($data['records'] as $idRecord) {
				$record = $em->getRepository(Record::class)->find($idRecord);
				//if (!$artist->getRecords()->contains($record)) {
				$artist->addRecord($record);
				//}
			}
			
			$em->flush();
			
			return $id;
		} catch (\Doctrine\ORM\ORMException $e) {
			throw $e;
		}
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::delete()
	 */
	public function delete($id) {
		
	}
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::findByCriteria()
	 */
	public function findByCriteria($value) {
		$criteria = array(
			'name' => $value,
			'surname' => $value
		);
		return $this->findBy($criteria);
	}
}