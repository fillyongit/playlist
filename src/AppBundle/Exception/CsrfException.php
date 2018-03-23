<?php 
namespace AppBundle\Exception;

class CsrfException extends \Symfony\Component\HttpKernel\Exception\HttpException
{
	public function __construct(\Symfony\Component\Translation\TranslatorInterface $translator, $message = '') {
		parent::__construct(403, ($message ? $message : $translator->trans('exceptions.security_csrf')), null, array(), 0);
	}
	
	// custom string representation of object
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}