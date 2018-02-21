<?php
namespace AppBundle\Entity;

abstract class AbstractEntity implements PlEntityInterface, \JsonSerializable
{
	/**
	 * Restituisce una rappresentazione json di un oggetto Entity di Doctrine.
	 * Un oggetto restituito da Doctrine ha molti membri ed è molto più grande 
	 * di quello che serve qui.
	 * Restituisce i valori dei membri che hanno un corrispettivo getter.
	 * 
	 * @return array
	 */
	public function jsonSerialize() {
		$json = array();
		foreach($this as $key => $value) {
			if (method_exists($this, 'get' . ucwords($key))) {
				$value = call_user_func(array($this, 'get' . ucwords($key)));
				if ($value instanceof \Countable) {
					// Restituisce le entity correlate. Non è ricorsivo, se la correlata
					// ne ha un'altra correlata quest'ultima non viene resituita.
					$relatedEntities = array();
					$relatedIds = array();
					foreach($value as $i=>$val) {
						$relatedIds[] = $val->getId();
						foreach($val as $k => $v) {
							if (method_exists($val, 'get' . ucwords($k))) {
								$relatedEntities[$i][strtolower($k)] = call_user_func(array($val, 'get' . ucwords($k)));
							}
						}
					}
					$value = $relatedIds;
					$json[strtolower($key) . 'Entities'] = $relatedEntities;
				}
				$json[strtolower($key)] = $value;
			}
		}
		return $json;
	}
}