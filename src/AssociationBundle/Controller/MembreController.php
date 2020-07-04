<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 2/16/2019
 * Time: 9:44 PM
 */

namespace AssociationBundle\Controller;


use AppBundle\Entity\MembreAssociation;
use AssociationBundle\Form\MembreAssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MembreController extends Controller
{
    public function Membaction(Request $request)
    {
        $Membre = new MembreAssociation();
        $form=$this->createForm(MembreAssociationType::class,$Membre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Membre);
            $em->flush();
            /* $id=$Association->getResponsable();
             $Responsable = $em->getRepository(Us::class)->find($id);*/

        }
        return $this->render('@Association/Default/Addmeb.twig',array('form'=>$form->createView()));

    }

    public function updateAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $id = $request->get('id');
        $Membre = $em->getRepository(MembreAssociation::class)->find($id);
        $form=$this->createForm(MembreAssociationType::class,$Membre);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Membre);
            $em->flush();
           // return $this->redirectToRoute('association_Afficher');
        }
        return $this->render('@Association/Default/modifmemb.twig',array('form'=>$form->createView()));

    }

    public function listerAction(Request $request)
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $Membres= $em->getRepository("AppBundle:MembreAssociation")->findBy(array('Assoc' =>$id ));

        return $this->render('@Association/Default/Listmemb.twig',array("Membres"=>$Membres));


    }
    public function listeradmAction(Request $request)
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $Membres= $em->getRepository("AppBundle:MembreAssociation")->findBy(array('Assoc' =>$id ));

        return $this->render('@Association/Default/Listmembadmin.twig',array("Membres"=>$Membres));


    }
    public function delAction(Request $request)
    {
        //creer une instance de l'entity manager
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $membres= $em->getRepository("AppBundle:MembreAssociation")->find($id);
        $em->remove($membres);
        $em->flush();
        return $this->redirectToRoute('association_Afficher');

    }
    public function deladmAction(Request $request)
    {
        //creer une instance de l'entity manager
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $membres= $em->getRepository("AppBundle:MembreAssociation")->find($id);
        $em->remove($membres);
        $em->flush();
        return $this->redirectToRoute('association_admin');

    }

}