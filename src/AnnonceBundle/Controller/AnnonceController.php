<?php

namespace AnnonceBundle\Controller;
use AppBundle\Entity\Annonce;
use AnnonceBundle\Form\AnnonceType;
use AppBundle\Entity\Commentaireannonce;
use AppBundle\Entity\Notification;
use AppBundle\Repository\AnnonceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

use AppBundle\Repository\AnnonceLikeRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\PostLike;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\Request;
class AnnonceController extends Controller
{
    public function annonceAction()
    {
        //echo
        return $this->render('@Annonce/Default/annonce.html.twig');
    }

    public function addAction(Request $request)
    {

            $annonce = new Annonce();

            $form = $this->createForm(AnnonceType::class, $annonce);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $file = $annonce->getPhoto();
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('annonce_directory'), $filename);
                $annonce->setPhoto($filename);
                $annonce->setCreateur($this->getUser());
                $annonce->setDateannonce(new \DateTime('now'));


                $em->persist($annonce);
                $em->flush();

                //return $this->redirectToRoute('afficher_produit');
                $this->addFlash('info', 'Contact page not ready yet !');
               // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                  //  return new RedirectResponse('/');
            }

            return $this->render('@Annonce/Default/add.html.twig', array(
                "Form" => $form->createView()
            ));
        }


    public function listAction()
    {
        //Créer une instance de l'Entity manager
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository("AppBundle:Annonce")
            ->findannonceByLikes();
        return $this->render('@Annonce/Default/show.html.twig'
            ,array(
                "annonces"=>$annonces

            ));
    }

    public function UpdateanAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository('AppBundle:Annonce')->find($id);
        $form = $this->createForm(AnnonceType::class, $an);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($an);
            $em->flush();
            return $this->redirectToRoute('showannonce');
        }
        return $this->render('@Annonce/Default/update.html.twig',
            array('form'=>$form->createView()));
    }
    public function deleteanAction(Request $request ){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Annonce = $em
            ->getRepository("AppBundle:Annonce")
            ->find($id);
        $em->remove($Annonce);
        $em->flush();
        return $this->redirectToRoute('showannonce');
    }

    public function ShowdetailedanAction($id){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository('AppBundle:Annonce')->find($id);
        return $this->render('@Annonce/Default/showone.html.twig', array(
            'titre'=>$an->getTitre(), 'date'=>$an->getDateannonce(),
            'description'=>$an->getDescription(),
            'createur',$an->getCreateur(),
            'annonces'=>$an,
            'commentaires'=>$an,

            'photo'=>$an->getPhoto(), 'id'=>$id
        ));
    }

    public function addCommentAction(Request $request, UserInterface $user)
    {
       //if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
         //   return new RedirectResponse('/login');
        //}
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'unable to access this page.');

        $ref = $request->headers->get('referer');

        $annonce = $this->getDoctrine()
            ->getRepository(Annonce::class)
            ->findAnnonceByid($request->request->get('annonce_id'));

        $comment = new Commentaireannonce();

        $comment->setUser($user);
        $comment->setAnnonce($annonce);
        $comment->setContenu($request->request->get('comment'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
            'info', 'Commentaire publié !.'
        );

        return $this->redirect($ref);

    }

    public function supprimerCommentaireAction(Commentaireannonce $commentaire, Request $request)
    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em
            ->getRepository("AppBundle:Commentaireannonce")
            ->find($id);
        $em->remove($commentaire);
        $em->flush();
        return $this->redirectToRoute('showannonce');
    }


    /**
     * @param Annonce $annonce
     * @param ObjectManager $manager
     * @param AnnonceLikeRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
//liker ou disliker un article
   /* public function likeAction(
      Annonce $annonce,  ObjectManager $objectManager
        ,AnnonceLikeRepository $annonceLikeRepository

    ): response{


        $user = $this->getUser();
        if (!$user) return $this->json([
            'code' => 403,
            'message' => 'Unauthorized'
        ], 403);
        if ($annonce->isLikeByUser($user)) {
            $like = $annonceLikeRepository->findOneBy([
                'annonce' => $annonce,
                'user' => $user
            ]);
            $objectManager->remove($like);
            $objectManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Like supprimer',
                'likes' => $annonceLikeRepository->count(['annonce' => $annonce])
            ], 200);
        }
        $like = new PostLike();
        $like->setAnnonce($annonce);
        $like->setUser($user);
        $objectManager->persist($like);
        $objectManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'Like bien ajouté',
            'likes' => $annonceLikeRepository->count(['annonce' => $annonce])
        ], 200);
    }
*/
    public function listadAction()
    {
        //Créer une instance de l'Entity manager
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository("AppBundle:Annonce")
            ->findAll();
        return $this->render('@Annonce/Admin/listannonce.html.twig'
            ,array(
                "annonces"=>$annonces

            ));
    }
    public function deleteadanAction(Request $request ){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Annonce = $em
            ->getRepository("AppBundle:Annonce")
            ->find($id);
        $em->remove($Annonce);
        $em->flush();
        return $this->redirectToRoute('listeannonce_admin');
    }


    public function findByLikesAction()
    {
        //Créer une instance de l'Entity manager
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository("AppBundle:Annonce")
            ->findAll();
        return $this->render('@Annonce/Default/annonce.html.twig'
            ,array(
                "annonces"=>$annonces

            ));
    }
    /*
    public function mainSearchAutocompleteAction()
    {
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {

            $key = $request->request->get('searchText');

            $annonces = $this->getDoctrine()->getRepository('AppBundle:Annonce')->findProductBySearchKey($key);

            $annonceWithImage = array();
            foreach((array)$annonces as $annonce){
                $annonceWithImage[] = array('photo'=> (string)$annonce->getNormalProductImage(), 'titre' => $annonce->getName(), 'description' => $annonce->getRealPrice() );
            }

            return new JsonResponse($annonceWithImage);

        }else{
            return new JsonResponse(array('success' => false));
        }

    }*/
    public function UpdateanadAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository('AppBundle:Annonce')->find($id);
        $form = $this->createForm(AnnonceType::class, $an);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($an);
            $em->flush();
            return $this->redirectToRoute('listeannonce_admin');
        }
        return $this->render('@Annonce/Admin/updateannonce.html.twig',
            array('form'=>$form->createView()));
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $annonces =  $em->getRepository('AppBundle:Annonce')->findEntitiesByString($requestString);
        if(!$annonces) {
            $result['annonces']['error'] = "Annonce non trouvé :( ";
        } else {
            $result['annonces'] = $this->getRealEntities($annonces);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($annonces){
        foreach ($annonces as $annonces){
            $realEntities[$annonces->getId()] = $annonces->getTitre();

        }
        return $realEntities;
    }


    public function createAjaxAction(Request $request)
    {
        $annonces = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonces, array(
            'action' => $this->generateUrl($request->get('_route'))
        ))
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($annonces);
            $this->getDoctrine()->getManager()->flush();
            return new Response('success');
        }

        return $this->render('@Annonce/Default/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function newPersonAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'Use only ajax please!'), 400);
        }

        $form = $this->createForm(AnnonceType::class, $user = new Annonce());
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }
        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('@Annonce/Default/add.html.twig',
                    array(
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }
    public function listtpAction()
    {
        //Créer une instance de l'Entity manager
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository("AppBundle:Annonce")
            ->findannonceByLikes();
        return $this->render('@Annonce/Admin/listannonce.html.twig'
            ,array(
                "annonces"=>$annonces

            ));
    }

}
