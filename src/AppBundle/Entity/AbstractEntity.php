<?php
namespace AppBundle\Entity;

abstract class AbstractEntity implements PlEntityInterface, \JsonSerializable
{
	/**
	 * Restituisce una rappresentazione json di un oggetto Entity di Doctrine.
	 * Ottiene i valori dei membri che hanno un corrispettivo getter.
	 * 
	 * @return json
	 */
	public function jsonSerialize() {
		$json = array();
		foreach($this as $key => $value) {
			if (method_exists($this, 'get' . ucwords($key))) {
				$json[strtolower($key)] = call_user_func(array($this, 'get' . ucwords($key)));
			}
		}
		return $json;
	}
}