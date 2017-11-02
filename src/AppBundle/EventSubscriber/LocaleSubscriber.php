<?php 
namespace AppBundle\EventSubscriber;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
	private $defaultLocale;
	
	public function __construct($defaultLocale = 'en')
	{
		$this->defaultLocale = $defaultLocale;
	}
	
	public function onKernelRequest(GetResponseEvent $event)
	{
		$request = $event->getRequest();
		if (!$request->hasPreviousSession()) {
			return;
		}
		
		// try to see if the locale has been set as a _locale routing parameter
		$locale = $request->attributes->get('_locale');
		$session_locale = $request->getSession()->get('_locale');
		if ($locale && $locale != $session_locale) {
			$request->getSession()->set('_locale', $locale);
		} else if ($session_locale) {
			// if no explicit locale has been set on this request, use one from the session
			// var_dump($session_locale);
			$request->setLocale($session_locale);
		}
	}
	
	public static function getSubscribedEvents()
	{
		return array(
				// must be registered after the default Locale listener
				KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
		);
	}
}