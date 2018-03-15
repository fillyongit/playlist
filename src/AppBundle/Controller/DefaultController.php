<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Record;
use AppBundle\Service\Model;
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
		
		//$this->get('twig')->addGlobal('is_test', $isTest);
	}
	
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }
    
    public function listAction(Request $request, 
    		$what = 'songs', 
    		$howMany = 100,
    		Model $model)
    {
    	$this->logger->info('listAction -> ' . $what . ' ' . $howMany);

    	// print $this->getParameter('database_name');
    	
    	$data = $model->getCollection(Artist::class);

    	// replace this example code with whatever you need
    	return $this->render('default/'.$what.'.html.twig', [
    		'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    		'title' => $this->translator->trans('title.'.$what),
    		'data' => $data
//     		, 'entries' => array(
//     				array('key' => 'locale', 'value' => $request->getLocale()),
//     				array('key' => 'title.albums_list', 'value' => $this->translator->trans('title.albums_list'))
//     		)
    	]);
    }
    
    public function entityAction($what, $id, Model $model) {
    	try {
    		$data = $model->getEntity(Artist::class, $id);
    	} catch (\Exception $e) {
    		$data['error'] = $this->translator->trans($e->getMessage());
    	}
    	return $this->json($data);
    }
    
    public function saveEntityAction(Request $request, Model $model, $what, $id = 0) {
    	try {
    		$data = $request->request->all();
    		if ($this->isCsrfTokenValid('artists-grid', $data['token'])) {
    			$data = $model->saveEntity(Artist::class, $id, $data);
    		} else {
    			throw \Exception($this->translator->trans('alert.security_csrf'));
    		}
    	} catch (\Exception $e) {
    		$data['error'] = $this->translator->trans($e->getMessage());
    	}
    	return $this->json($data);
    }
    
    public function liveSearchAction(Request $request, Model $model, $what) {
    	$data = $model->getCollection(Record::class);
    	return $this->json($data);
    }
}
