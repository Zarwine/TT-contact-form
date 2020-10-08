<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, EntityManagerInterface $manager)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
                     ->add('lastname')
                     ->add('firstname')
                     ->add('mail')
                     ->add('phone')
                     ->add('content')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();

            $notifConfirm = "Merci de nous avoir contacté";
            return $this->render('home.html.twig', [
                "notif" => $notifConfirm
            ]);
        }

        return $this->render('contact/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('home.html.twig');
    }
}
