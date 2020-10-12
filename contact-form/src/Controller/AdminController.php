<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 * 
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     */
    public function dashboard(ContactRepository $repo)
    {
        $contacts = $repo->findAll();

        return $this->render('admin/admin.html.twig', [
            'contacts' => $contacts
        ]);
    }
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/view_message", name="view_message", methods={"POST"})
     */
    public function viewMessage(ContactRepository $repo, Request $request, EntityManagerInterface $manager)
    {
        $submittedToken = $request->request->get('_token');

        if ($this->isCsrfTokenValid('view-message', $submittedToken)) {
            $messages = $request->request->get("message");
            $entityManager = $this->getDoctrine()->getManager();
            $ids = array_keys($messages);

            foreach ($ids as $id) {
                $message = $entityManager->getRepository(Contact::class)->find($id);
                if (!$message) {
                    throw $this->createNotFoundException(
                        "Aucun message ne possède l'id suivant : " . $id
                    );
                }
                $message->setViewed( ! $message->getViewed() );

                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('admin_dashboard');
    }
}
