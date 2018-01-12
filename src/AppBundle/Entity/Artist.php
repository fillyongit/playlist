<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 */
class Artist
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
	 * @ORM\Column(type="string", name="surname", length=100)
	 */
	private $surName;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $notes;
	
	/**
	 * @ORM\Column(type="datetime", name="birthdate", length=100)
	 */
	private $birthDate;
}