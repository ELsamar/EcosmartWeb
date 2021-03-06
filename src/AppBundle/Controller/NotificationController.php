<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends Controller
{

    public function displayAction()
    {
        $notifications = $this->getDoctrine()->getManager()->getRepository('AppBundle:Notification')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/notifications.html.twig',
            array(
                'notifications' =>$notifications
            )
            );
    }
}
