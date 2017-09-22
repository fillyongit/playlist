<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
	/**
	 * @Route("/lucky/number/{slug}")
	 */
	public function numberAction($slug = '')
	{
		$number = mt_rand(0, 100);
		
// 		return new Response(
// 				'<html><body>Lucky number: '.$number.'</body></html>'
// 				);

		$mailhook = new \Ingenerator\Mailhook\Mailhook('/var/log/mail.log');
		
		$mails = $mailhook->getEmails();

		return $this->render('lucky/number.html.twig', array(
				'number' => $number,
		));
	}
}