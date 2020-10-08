<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
    public function adminDashboard()
    {
        return $this->render('admin/admin.html.twig');
    }
}