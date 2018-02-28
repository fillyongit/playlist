<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\AppBundle;

abstract class PlEntityRepository extends EntityRepository {
	
	/**
	 * Esegue una query che resotuisce l'entità corrente più le correlate.
	 * 
	 * @abstract
	 * @param $id
	 * @return un oeggetto di tipo \AppBundle\Entity\PlEntityInterface
	 */
	abstract public function findFullOneById($id);
	
	/**
	 * Esegue una query che resotuisce l'entità corrente più le correlate.
	 *
	 * @abstract
	 * @param $id
	 * @param $data
	 * @throws \Doctrine\ORM\ORMException
	 * @return integer
	 */
	abstract public function save($id, array $data);
	
	/**
	 * Esegue una query che resotuisce l'entità corrente più le correlate.
	 *
	 * @abstract
	 * @param $id
	 * @return integer
	 */
	abstract public function delete($id);
}