<?php

namespace AppBundle\Controller;

use AppBundle\Service\Model;
use AppBundle\Exception\CsrfException;
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
    		Model $model,
    		$what = 'songs', 
    		$howMany = 100)
    {
    	$this->logger->info('listAction -> ' . $what . ' ' . $howMany);

    	// print $this->getParameter('database_name');

    	$data = $model->getCollection('AppBundle:Artist');

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
    
    public function entityAction(Model $model, $what, $id) {
    	try {
    		$data = $model->getEntity('AppBundle:Artist', $id);
    	} catch (\Exception $e) {
    		$data['error'] = $this->translator->trans($e->getMessage());
    	}
    	return $this->json($data);
    }
    
    public function saveEntityAction(Request $request, Model $model, $what, $id = 0) {
    	try {
    		$data = $request->request->all();
    		if ($this->isCsrfTokenValid('grid', $data['token'])) {
    			$data = $model->saveEntity('AppBundle:Artist', $id, $data);
    		} else {
    			throw  new CsrfException($this->translator);
    		}
    	} catch (\Exception $e) {
    		$data['error'] = $this->translator->trans($e->getMessage());
    	}
    	return $this->json($data);
    }
    
    public function liveSearchAction(Request $request, Model $model, $what) {
    	$data = array();
    	if ($this->isCsrfTokenValid('grid', $request->request->get('token'))) {
    		$collection = $model->getCollection('AppBundle:Record', $request->request->get('search'));
    		foreach($collection as $row) {
    			// Ogni $row è un oggetto di tipo AbstractEntity 
    			// che implementa l'interfaccia JsonSerializable e implementa
    			// il metodo jsonSerialize.
    			$data[] = json_encode($row);
    		}
    	} else {
    		throw new CsrfException($this->translator);
    	}

    	return $this->json($data);
    }
}
