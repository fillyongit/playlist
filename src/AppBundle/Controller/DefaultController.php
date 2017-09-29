<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class DefaultController extends Controller
{
	private $logger;
	
	public function __construct(LoggerInterface $logger) {
		$this->logger = $logger;
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
    
    /**
     * @Route("/list/{what}/{howMany}", name="list")
     */
    public function listAction(Request $request, 
    		$what = 'artists', 
    		$howMany = 100, 
    		LoggerInterface $logger)
    {
    	$this->logger->info('listAction -> ' . $what . ' ' . $howMany);
    	
    	// replace this example code with whatever you need
    	return $this->render('default/list.html.twig', [
    		'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    	]);
    }
}
