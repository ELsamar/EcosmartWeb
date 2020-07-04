<?php

namespace AssociationBundle\Controller;

use AppBundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\DependencyInjection\ContainerInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AssociationBundle:Default:index.html.twig');
    }
  /*  public function sendAction(Request $request){

        $mail = new Mail();

        $mail->setEmail($request->get('email'));
        $mail->setMessage($request->get('msg'));
        $message = \Swift_Message::newInstance()
            ->setSubject('Acceptation Demande')
            ->setFrom('ecosmartpluus@gmail.com')
            ->setTo('ahmed.sahli@esprit.tn')
            ->setBody(
                $this->renderView(
                    '@Association/Default/mail.html.twig'

                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('association_homepage');


    }*/
    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search", name="ajax_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository('AppBundle:Association')->findEntitiesByString($requestString);
        if(!$entities) {
            $result['entities']['error'] = "keine Einträge gefunden";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getNom();
        }
        return $realEntities;
    }






}
