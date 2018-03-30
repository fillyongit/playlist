<?php
namespace AppBundle\Repository;

class RecordRepository extends PlEntityRepository
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::delete()
	 */
	public function delete($id) {
		
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::save()
	 */
	public function save($id, array $data) {
		
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::findFullOneById()
	 */
	public function findFullOneById($id) {
		
	}
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Repository\PlEntityRepository::findByCriteria()
	 */
	public function findByCriteria($value) {
		$query = $this->getEntityManager()->createQuery(
				'SELECT r FROM AppBundle:Record r 
       			 WHERE r.name LIKE :name'
		)->setParameter('name', '%' . $value . '%');

		return $query->getResult();
	}
}