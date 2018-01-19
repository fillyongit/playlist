<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 */
class Artist implements PlEntityInterface
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="string", name="surname", length=100, nullable=TRUE)
	 */
	private $surName;
	
	/**
	 * @ORM\Column(type="text", nullable=TRUE)
	 */
	private $notes;
	
	/**
	 * @ORM\Column(type="datetime", name="birthdate", length=100, nullable=TRUE)
	 */
	private $birthDate;

	public function __get($name) {
		if (property_exists(__CLASS__, $name)) {
			return $this->$name;
		} else {
			throw new \Exception('Proprietà ' . $name . ' insesistente in ' . __CLASS__);
		}
	}
}