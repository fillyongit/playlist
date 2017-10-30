<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
	private $logger;
	
	private $translator;
	
	private $session;
	
	public function __construct(
			LoggerInterface $logger,
			TranslatorInterface $translator,
			SessionInterface $session
	) {
		$this->logger = $logger;
		$this->translator = $translator;
		$this->session = $session;
	}
	
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    
    public function listAction(Request $request, 
    		$what = 'artists', 
    		$howMany = 100)
    {
    	$this->logger->info('listAction -> ' . $what . ' ' . $howMany);

    	// print $this->getParameter('database_name');
    	
    	// replace this example code with whatever you need
    	return $this->render('default/list.html.twig', [
    		'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    		'entries' => array(
    				array('key' => 'locale', 'value' => $request->getLocale()),
    				array('key' => 'title.albums_list', 'value' => $this->translator->trans('title.albums_list'))
    		)
    	]);
    }
}
