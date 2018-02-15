<?php
namespace AppBundle\Entity;

abstract class AbstractEntity implements PlEntityInterface, \JsonSerializable
{
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