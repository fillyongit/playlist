<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;

class SecurityController extends Controller {
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
    public function registerAction(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $plainPassword = 'password';
        $encoded = $encoder->encodePassword($user, $plainPassword);
        $user->setUsername('admin');
        $user->setPassword($encoded);
        $user->setEmail('a@example.com');
        $em->persist($user);
        $em->flush();
        
        return new Response('<html><body>Utente registrato!<br />Password: '.$encoded.'</body></html>');
    }
}