<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionUserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users =  $em->getRepository('AppBundle:User')->findAll();
        return $this->render('@User/Admin/Default/users.html.twig', array('users' => $users));
    }

    public function deleteAction(Request $request, $id) {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $article = $em -> getRepository("AppBundle:User")->find($id);

        $em ->remove($article);
        $em ->flush();
        $response = new Response();
        $response->send();
    }
}
