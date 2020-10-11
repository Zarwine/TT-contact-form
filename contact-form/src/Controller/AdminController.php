<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin", name="admin")
     */
    public function adminDashboard(ContactRepository $repo)
    {
        $contacts = $repo->findAll();             

        return $this->render('admin/admin.html.twig', [
            'contacts' => $contacts
        ]);
    }
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin2", name="admin_check")
     */
    public function checkMessage(ContactRepository $repo)
    {
        var_dump($_POST);
        exit;
        $contacts = $repo->findAll();             

        return $this->render('admin/admin.html.twig', [
            'contacts' => $contacts
        ]);
    }
}
