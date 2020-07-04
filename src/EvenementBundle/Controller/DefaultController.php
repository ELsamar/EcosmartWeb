<?php

namespace EvenementBundle\Controller;

use AppBundle\Entity\Mail;
use AppBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction (){
        return $this->render('@Evenement/Default/acceuilevent.html.twig');
    }


}

