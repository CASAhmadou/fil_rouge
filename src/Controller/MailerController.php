<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function __invoke(MailerInterface $mailer): Response
    {
        // dd($this->getUser());
        $email = (new Email())
            ->from('hello@example.com')
            ->to("sakho@gmail.com")
            ->subject('Creation de compte client!')
            ->text('creer votre compte pour profiter de nos delicieux burgers!')
            ->html('<p>voici votre token de connexion!</p>');

        $mailer->send($email);

        // return null;
        // ...
        return $this->render('mailer/mail.html.twig');
    }
     
    #[Route("/confirmAccount/{token}", name:"confirm_account")]
    public function confirmAccount(string $token, ClientRepository $repo,EntityManagerInterface $manager)
    {
        $user = $repo->findOneBy(["token" => $token]);
        if($user && ($user->getExpiredAt() > new \DateTime() ) && ($user->isIsVerified()==false)) {
            $user->setToken("");
            $user->setIsVerified(true);
            //$em = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            
            return $this->json(["succes"=>"votre compte a été activé","status"=>200],200);
        } 
        else{
            return $this->json(["succes"=>"votre compte n est pas activé","status"=>400],Response::HTTP_BAD_REQUEST);
        }
    }
}