<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 2/16/2019
 * Time: 6:17 PM
 */

namespace AssociationBundle\Controller;


use AppBundle\Entity\Association;
use AppBundle\Entity\DemandeAssociation;
use AppBundle\Entity\Mail;
use AppBundle\Entity\MembreAssociation;
use AppBundle\Entity\User;
use AssociationBundle\Form\DemandeAssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemandeController extends  Controller
{

    public function demandeaction(Request $request)
    {
        $Demande = new DemandeAssociation();
        $id = $request->get('id');

        $form=$this->createForm(DemandeAssociationType::class,$Demande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $dem = $em->getRepository(Association::class)->find($id);
            $Demande->setNom($this->getUser()->getNom());
           $Demande->setEmail($this->getUser()->getEmail());
             $Demande->setUtilisateur($this->getUser());
           $Demande->setAssociation($dem);
            $Demande->setEtat('En attente');
            $em->persist($Demande);
            $em->flush();
            /* $id=$Association->getResponsable();
             $Responsable = $em->getRepository(Us::class)->find($id);*/
            return $this->redirectToRoute('association_Afficher');

        }
        return $this->render('@Association/Default/demande.html.twig',array('form'=>$form->createView()));

    }
    public function modifdemanAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $id = $request->get('id');
        $Demande= $em->getRepository(DemandeAssociation::class)->find($id);
        $form=$this->createForm(DemandeAssociationType::class,$Demande);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Demande);
            $em->flush();
            return $this->redirectToRoute('association_Afficher');
        }
        return $this->render('@Association/Default/modemande.twig',array('form'=>$form->createView()));

    }



    public function acceptaction(Request $request)
    {
        $Membre = new MembreAssociation();
        $id = $request->get('id');
        $ass = $request->get('ida');
        $dem = $request->get('idd');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $assos = $em->getRepository(Association::class)->find($ass);
        $demande = $em->getRepository(DemandeAssociation::class)->find($dem);
        $demande->setEtat("Acceptée");
        $user->getEmail();

        $Membre->setAssoc($ass);
        $Membre->setId($id);
        $Membre->setNom($user->getNom());
        $Membre->setPrenom($user->getPrenom());
        $Membre->setAdresse('xx');
        $Membre->setNumContact(1122);

        $Membre->setScore(0);
        //$assos->setMembres($user);
        $em->persist($Membre);

        $em->flush();
        //$Membre->setScore($user->get);
        $mail = new Mail();

        $mail->setEmail($request->get('email'));
        $mail->setMessage($request->get('msg'));
        $message = \Swift_Message::newInstance()
            ->setSubject('Acceptation Demande')
            ->setFrom('ecosmartpluus@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    '@Association/Default/mail.html.twig',array("Association"=>$assos)

                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('association_homepage');


        return $this->redirectToRoute('association_Afficher');
    }
    public function refuseraction(Request $request)
    {


        $dem = $request->get('idd');
        $em = $this->getDoctrine()->getManager();

        $demande = $em->getRepository(DemandeAssociation::class)->find($dem);
        $demande->setEtat("Reusée");
        return $this->redirectToRoute('association_Afficher');

    }


    public function listAction(Request $request)
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $demandes= $em->getRepository("AppBundle:DemandeAssociation")->findBy(array('Association' =>$id ,"Etat"=>"En attente"));

        return $this->render('@Association/Default/listdemande.twig',array("demandes"=>$demandes));


    }
    public function mesdemandesAction(Request $request)
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();
       $utilisateur= $this->getUser();
        $demandes= $em->getRepository("AppBundle:DemandeAssociation")->findBy(array('Utilisateur' =>$utilisateur ));
        return $this->render('@Association/Default/Mesdemandes.html.twig',array("demandes"=>$demandes));


    }
    public function deldemandeaction(Request $request)
    {


        $dem = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $demande = $em->getRepository(DemandeAssociation::class)->find($dem);
        $em->Remove($demande);

        $em->flush();
        return $this->redirectToRoute('association_Afficher');

    }
}