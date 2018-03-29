<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecordRepository")
 * @ORM\Table(name="record")
 */
class Record extends AbstractEntity
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $name;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Artist", mappedBy="records")
	 */
	protected $artists;
	
	public function __construct() {
		$this->artists = new ArrayCollection();
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getArtists() {
		return $this->artists;
	}
	
	public function addArtist(Artist $artist)
	{
		$artist->addRecord($this); // synchronously updating inverse side
		$this->artists[] = $artist;
	}
}