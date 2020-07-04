<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function adminAction()
    {
        return $this->render('@User/Admin/Default/index.html.twig');
    }
    public function citoyenAction()
    {
        return $this->render('@User/Citoyen/index.html.twig');
    }
    public function recycleurAction()
    {
        return $this->render('@User/Recycleur/index.html.twig');
    }
    public function collecteurAction()
    {

        return $this->render('@User/Collecteur/index.html.twig');
    }

}
