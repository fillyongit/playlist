<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 */
class Artist extends AbstractEntity
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
	protected $name;
	
	/**
	 * @ORM\Column(type="string", name="surname", length=100, nullable=TRUE)
	 */
	protected $surName;
	
	/**
	 * @ORM\Column(type="text", nullable=TRUE)
	 */
	protected $notes;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Record", inversedBy="artists")
	 * @ORM\JoinTable(name="artist_records")
	 */
	protected $records;
	
	/**
	 * @ORM\Column(type="datetime", name="birthdate", length=100, nullable=TRUE)
	 */
	protected $birthDate;

	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getSurName() {
		return $this->surName;
	}
	
	public function getBirthDate() {
		return $this->birthDate->format('d-m-Y');
	}
}