<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

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
			return null;
		}
	}
}