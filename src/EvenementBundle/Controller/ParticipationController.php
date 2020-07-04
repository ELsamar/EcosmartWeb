<?php

namespace EvenementBundle\Controller;


use AppBundle\Entity\Evenement;
use AppBundle\Entity\Mail;
use AppBundle\Entity\Participation;
use AppBundle\Entity\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function participateAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $event->setNb($event->getNb()+1);

        $participation = new Participation();
        $participation ->setParticipant($this->getUser());
        $participation ->setEvent($event);
        $participation ->setDatedeparti(new \DateTime('now'));
        $participation ->setType('participer');

            $em= $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->persist($event);
            $em->flush();

        return $this->redirectToRoute('evenement_detail', array(
            'id'=>$id
        ));
    }
    public function myparticipAction(){

        $em = $this -> getDoctrine()-> getManager();
        $participation = $em -> getRepository("AppBundle:Participation")
            ->findBy((array(
                'participant' => $this->getUser(),
                'type' => 'participer'
            )));

        return $this->render('@Evenement/Default/participation.html.twig'
            ,array(
                "participations"=>$participation
            ));
    }
    public function MyinvitepAction(){

        $em = $this -> getDoctrine()-> getManager();
        $participation = $em -> getRepository("AppBundle:Participation")
            ->findBy((array(
                'participant' => $this->getUser(),
                'type' => 'inviter'
            )));

        return $this->render('@Evenement/Default/invitevent.html.twig'
            ,array(
                "participations"=>$participation
            ));
    }
    public function supppparticipAction(Request $request)
    {
        $ide= $request->get('ide');
        $idp = $request->get('idp');
        $em = $this->getDoctrine()->getManager();
        $partipation = $em -> getRepository("AppBundle:Participation")->find($idp);
        //$modele de type objet
        $event= $em -> getRepository("AppBundle:Evenement")->find($ide);
        $event->setNb($event->getNb()-1);
        $em ->remove($partipation);
        $em ->flush();
        return $this->redirectToRoute('evenement_detail', array(
            'id'=>$ide
        ));

    }
    public function acceptpartiAction(Request $request)
    {
        $ide= $request->get('ide');
        $idp = $request->get('idp');
        $em = $this->getDoctrine()->getManager();
        $partipation = $em -> getRepository("AppBundle:Participation")->find($idp);
        //$modele de type objet
        $partipation->setType('participer');
        $em ->persist($partipation);
        $em ->flush();
        return $this->redirectToRoute('evenement_detail', array(
            'id'=>$ide
        ));

    }
    public function  inviterEventAction (Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user = new User();
        $user = $em->getRepository("AppBundle:User")
            ->findAll();
        $id = $request->get('id');

        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);

        return $this->render('@Evenement/Default/Inviter.html.twig'
            ,array(
                "users"=>$user,
                'event'=>$event
            ));
    }

    public function ajoutinvitAction(Request $request,$iduser, $idevent){
        $em=$this->getDoctrine()->getManager();

        $user = $em->getRepository("AppBundle:User")
            ->find($iduser);
        $event = $em->getRepository("AppBundle:Evenement")
          ->find($idevent);

            $event->setNb($event->getNb()+1);
            $participation = new Participation();
            $participation ->setParticipant($user);
            $participation ->setInvitant($this->getUser());
            $participation ->setEvent($event);
            $participation ->setDatedeparti(new \DateTime('now'));
            $participation ->setType('inviter');

            $em= $this->getDoctrine()->getManager();
            $em->persist($participation);

            $em->persist($event);
            $em->flush();


        $mail = new Mail();

        $mail->setEmail($request->get('email'));
        $mail->setMessage($request->get('msg'));
        $message = \Swift_Message::newInstance()
            ->setSubject('Invitation Evenement')
            ->setFrom('ecosmartpluus@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    '@Evenement/Default/mailinvitation.html.twig',
                    array(
                        'invitant'=>$user,
                        'event'=>$event,
                        'user'=>$this->getUser())

                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->render('@Evenement/Default/Inviter.html.twig'
            ,array(
                "users"=>$user,
                'event'=>$event
            ));
    }


    //ajouter une route pour l'joute des invite

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
        $entities =  $em->getRepository('AppBundle:User')->FindUser($requestString);
        if(!$entities) {
            $result['entities']['error'] = "Le nom d'utilisateur de votre amis n'existe pas";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getUsername();
        }
        return $realEntities;
    }
    /********* ADMIN*******/
    public function listParticipantAction(Request $request){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $participation = $em -> getRepository("AppBundle:Participation")
            ->FindParticipant($event);

        return $this->render('@Evenement/admin/listparticipant.html.twig', array(
            'participations'=>$participation,
            'event'=>$event
        ));
    }
    public function filtreParticipantAction($id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $participation = $em -> getRepository("AppBundle:Participation")
            ->Filterparti($event);

        return $this->render('@Evenement/admin/listparticipant.html.twig', array(
            'participations'=>$participation,
            'event'=>$event
        ));
    }
    public function filtreinviteAction($id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $participation = $em -> getRepository("AppBundle:Participation")
            ->Filterinvi($event);

        return $this->render('@Evenement/admin/listparticipant.html.twig', array(
            'participations'=>$participation,
            'event'=>$event
        ));
    }
}
