<?php

namespace AssociationBundle\Controller;


use AppBundle\Entity\Association;

use AppBundle\Entity\Commentaireannonce;

use AssociationBundle\Form\AssociationType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\AST\OrderByClause;
use Exception;

use AppBundle\Repository\AssociationLikeRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\PostLikeAssociation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\Request;


class AssociationController extends Controller
{
    public function associationAction()
    {
        return $this->render('@Association/Default/association.html.twig');
    }

    public function addAction(Request $request)
    {


        $Association = new Association();

        $form=$this->createForm(AssociationType::class,$Association);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $Association->getLogo();

            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('photos_directory'), $filename
            );
            $Association->setLogo($filename);
            $Association->setResponsable($this->getUser());

            $em->persist($Association);
            $em->flush();
            return $this->redirectToRoute('association_Afficher');
           /* $id=$Association->getResponsable();
            $Responsable = $em->getRepository(Us::class)->find($id);*/

        }
        return $this->render('@Association/Default/Add.html.twig',array('form'=>$form->createView()));

    }



    public function updateAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $id = $request->get('id');
        $Association = $em->getRepository(Association::class)->find($id);
        $form=$this->createForm(AssociationType::class,$Association);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $file = $Association->getLogo();

            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('photos_directory'), $filename
            );
            $Association->setLogo($filename);
            $em->persist($Association);
            $em->flush();
            return $this->redirectToRoute('association_Afficher');
        }
        return $this->render('@Association/Default/modif.html.twig',array('form'=>$form->createView()));

    }


    public function listerAction()
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();
        $responsable=$this->getUser();
        $Associations= $em->getRepository("AppBundle:Association")->findAll();

        return $this->render('@Association/Default/list.html.twig',array("Associations"=>$Associations,
            "responsable"=>$responsable));

    }
    public function detailAction($id)
    {
        //creer une instance de l'entity manager

        $em = $this->getDoctrine()->getManager();

        $Associations = $em->getRepository(Association::class)->find($id);

        return $this->render('@Association/Default/detailleAssoc.html.twig',array("Association"=>$Associations));


    }

    public function statAction(){
        $em = $this->getDoctrine()->getManager();
        $Associations= $em->getRepository("AppBundle:Association")->findAll();
        $pieChart = new PieChart();
        $data= array();
        $stat=['Association', 'Nombre'];
        array_push($data,$stat);
        foreach($Associations as $association) {
            $nb= $em->getRepository("AppBundle:MembreAssociation")->countmembre($association);

              $stat=array();
            array_push($stat,$association->getNom(),$nb/3);

             $stat=[$association->getNom(),$nb/3];
            array_push($data,$stat);


        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des Membres par association');
        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(900);

        return $this->render('@Association/Default/stat.html.twig',array('piechart'=>$pieChart));
    }

    public function statnbAction(){
        $em = $this->getDoctrine()->getManager();
        $Associations= $em->getRepository("AppBundle:Association")->findAll();
        $bar = new BarChart();
        $data= array();
        $stat=['Association', 'Nombre des Membres '];
        array_push($data,$stat);
        foreach($Associations as $association) {
            $nb= $em->getRepository("AppBundle:MembreAssociation")->countmembre($association);

            $stat=array();
            array_push($stat,$association->getNom(),$nb/3*3);

            $stat=[$association->getNom(),$nb/3*3];
            array_push($data,$stat);


        }


        $bar->getData()->setArrayToDataTable($data);
        $bar->getOptions()->setTitle('Association et Membres');
        $bar->getOptions()->getHAxis()->setTitle('Nombre des Membres');

        $bar->getOptions()->getHAxis()->setMinValue(0);
        $bar->getOptions()->setWidth(1000);
        $bar->getOptions()->setHeight(500);

        return $this->render('@Association/Default/stat2.html.twig',array('barchart'=>$bar));
    }
    public function listadminAction()
    {
        //creer une instance de l'entity manager
        $em = $this->getDoctrine()->getManager();

        $Associations= $em->getRepository("AppBundle:Association")->findAll();
        return $this->render('@Association/Default/listadmin.html.twig',array("Associations"=>$Associations));


    }



    public function deleteAction(Request $request){
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Association=$em->getRepository(Association::class)->find($id);
        $em->remove($Association);
        $em->flush();
        return $this->redirectToRoute('association_Afficher');

    }
    //liker ou disliker un article
  /*  public function likeAction(
          Association $association, ObjectManager $objectManager
          , AssociationLikeRepository $associationLikeRepository

      ): response{


          $user = $this->getUser();
          if (!$user) return $this->json([
              'code' => 403,
              'message' => 'Unauthorized'
          ], 403);
          if ($association->isLikeByUser($user)) {
              $like = $associationLikeRepository->findOneBy([
                  'association' => $association,
                  'user' => $user
              ]);
              $objectManager->remove($like);
              $objectManager->flush();
              return $this->json([
                  'code' => 200,
                  'message' => 'Like supprimer',
                  'likes' => $associationLikeRepository->count(['association' => $association])
              ], 200);
          }
          $like = new PostLikeAssociation();
          $like->setAssociation($association);
          $like->setUser($user);
          $objectManager->persist($like);
          $objectManager->flush();
          return $this->json([
              'code' => 200,
              'message' => 'Like bien ajouté',
              'likes' => $associationLikeRepository->count(['association' => $association])
          ],200);
      }*/


}
