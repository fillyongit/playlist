<?php 
namespace AppBundle\Service;

use AppBundle\Entity\PlEntityInterface;

class EntityCreator {
	/**
	 * @return PlEntityInterface
	 */
	public function makeEntity($type) {
		return new $type;
	}
}