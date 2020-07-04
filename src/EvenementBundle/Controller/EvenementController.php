<?php

namespace EvenementBundle\Controller;

use AppBundle\Entity\Evenement;

use AppBundle\Entity\Mail;
use AppBundle\Entity\Participation;
use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use EvenementBundle\Form\EvenementType;
use EvenementBundle\Form\ReviewType;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EvenementController extends Controller
{
    ////////front ///////////////
    public function eventAction(Request $request)
    {
        $event = $this->topEventAction();
        return $this->render('@Evenement/Default/event.html.twig', array('events' => $event));
    }


    public function addeventAction(Request $request){
        $event = new Evenement();
        $date=new \DateTime('now');
        $date->format('Ymd');
        $event->setDateajout(new \DateTime('now'));
        $event->setNb(0);
        $form= $this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datefrm=$form->get('start')->getData();
            $datefrm->format('Ymd');
            if( ( $datefrm)< $date) {
                $this->get('session')->getFlashBag()->add(
                    'error',
                    'c\'est une date passée , voulez choisir une autre date'
                );
                return $this->render('@Evenement/Default/addevent.html.twig',array('form'=>$form->createView()));
            }
            $em = $this->getDoctrine()->getManager();

            $file = $event->getAffiche();

            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('event_directory'), $filename
            );
            $event->setAffiche($filename);
            $event->setCreateur($this->getUser());
            $event->setEtat('en attente');
            $event->setRealise(1);
            $event->setVu(0);
            $event->setEtoile(0);
            $em->persist($event);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre demande est envoyé au administrateur , tu vas recevoir la reponse le plutot possible , merci pour votre fidélité'
            );
            return $this->redirectToRoute('evenement_addevent');
        }
        return $this->render('@Evenement/Default/addevent.html.twig',array('form'=>$form->createView()));

    }
    public function listAction(Request $request){
        $em = $this -> getDoctrine()-> getManager();
        $events = $em -> getRepository("AppBundle:Evenement")
           ->FindAcceptedEv();
        if ($request -> isMethod('post')){
            $search=$request->get('search');
            $event = $em->getRepository("AppBundle:Evenement")
                ->FindByName($search);
            return $this->render('@Evenement/Default/listevent.html.twig', array('events' => $event));
        }
        return $this->render('@Evenement/Default/listevent.html.twig'
            ,array(
                "events"=>$events
            ));
    }



    public function detaileventAction(Request $request){
        $user = new User();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $vu = $this->Vuevent($event);
        $parti = $em->getRepository("AppBundle:Participation")
            ->Findparti($this->getUser(),$event);

        $nbinvit =  $em->getRepository("AppBundle:Participation")
            ->countinvite($event);
        $nbparticip = $em->getRepository("AppBundle:Participation")
            ->countparticip($event);
        return $this->render("@Evenement/Default/detailevent.html.twig",array(
            "events"=>$event,
            "particip"=> $parti,
            'users'=>$user,
            'nbinvit'=>$nbinvit,
            'nbparticip'=>$nbparticip,
            'vu'=>$vu
        ));
    }
    public function chercheuserAction(Request $request){
        $em=$this->getDoctrine()->getManager();
       $user = new User();
        if ($request -> isMethod('POST')){
            $nom=$request->get('nom');
            $user = $em->getRepository("AppBundle:User")
                ->findBy(array(
                    'nom' => $nom
                ));
        }
        if ($request->isXmlHttpRequest()) {

            $serializer = new Serializer(array(new ObjectNormalizer()));

            $events = $em->getRepository('AppBundle:User')
                ->findBy(array( 'nom' => $nom));

            $data = $serializer->normalize($events);

            return new JsonResponse($data);
        }

        return $this->redirectToRoute('evenement_recherch'
            ,array(
                "users"=>$user
            ));
    }

    public function updateeventAction(Request $request){
        $id = $request ->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Evenement')
            ->find($id);
        $form = $this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $file = $event->getAffiche();

            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('event_directory'), $filename
            );
            $event->setAffiche($filename);
            $em->persist($event);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'votre evenment est bien modifiè'
            );
            return $this->redirectToRoute('evenement_listevent');
        }
        return $this->render('@Evenement/Default/updatevent.html.twig'
            ,array(
                "Form"=>$form->createView()
            ));
    }
    public function annuleventAction(Request $request){
        $id = $request ->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Evenement')
            ->find($id);
        $particip = $em->getRepository('AppBundle:Participation')
            ->findBy(array(
                'event'=>$event
            ));

        $event->setRealise('0');
            $em->persist($event);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'info',
                'votre l\'événement est annulé'
            );
        foreach($particip as $p)
        {

            $mail = new Mail();

            $mail->setEmail($request->get('email'));
            $mail->setMessage($request->get('msg'));
            $message = \Swift_Message::newInstance()
                ->setSubject('annuler Evenement')
                ->setFrom('ecosmartpluus@gmail.com')
                ->setTo($p->getParticipant()->getEmail())
                ->setBody(
                    $this->renderView(
                        '@Evenement/Default/mail.html.twig',
                        array(
                            'participant'=>$p->getParticipant(),
                            'event'=>$event)

                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }
            return $this->redirectToRoute('evenement_detail',array(
                "id"=>$id
            )) ;
    }
    public function usereventAction(){
        $em = $this -> getDoctrine()-> getManager();
        $events = $em -> getRepository("AppBundle:Evenement")
            ->FindMyEv($this->getUser());
        return $this->render('@Evenement/Default/myevent.html.twig'
            ,array(
                "events"=>$events
            ));
    }

    public function CalendarAction(){
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Evenement')->findAll();
        return $this->render('@Evenement/Default/calendar.html.twig', array(
            'evenements'=>$events
        ));
    }

    public  function LoadEvCalendarAction(){
        $em = $this->getDoctrine()->getManager();
        $listEv = $em->getRepository('AppBundle:Evenement')->findAll();
        $listEvJson = array();
        foreach ($listEv as $event)
            $listEvJson[] = array(
                'title' => $event->getTitre(),
                'start' => "" . ($event->getStart()->format('Y-m-d')) . "",
                'end' => "" . ($event->getStart()->format('Y-m-d')) . "",
                'id' => "" . ($event->getId()) . ""
            );
        return new JsonResponse(array('events' => $listEvJson));
    }

    public function filterEventAction(Request $request){
        $type = $request->get('type');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->FindByType($type);
        return $this->render("@Evenement/Default/listevent.html.twig",array(
            "events"=>$event,

        ));

    }
    public function trierEventAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->ORDERBYevent();
        return $this->render("@Evenement/Default/listevent.html.twig",array(
            "events"=>$event,

        ));
    }

    public function trieretoileEventAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->ORDERBYetoileevent();
        return $this->render("@Evenement/Default/listevent.html.twig",array(
            "events"=>$event,
        ));
    }
    public function trierPartiAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->ORDERBYparticipantevent();
        return $this->render("@Evenement/Default/listevent.html.twig",array(
            "events"=>$event,

        ));
    }

    public function topEventAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")->TopEvent();
        return $event;
    }
    public function topEtoileEventAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")->TopetoileEvent();
        return $event;
    }
    public function Vuevent(Evenement $event){
        $em = $this -> getDoctrine()-> getManager();
        $event->setVu($event->getVu()+1);
        $em->persist($event);
        $em->flush();
        return $event->getVu();
    }

    public function detailRatingeventAction(Request $request){
        $user = new User();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);

        $dateauj =new \DateTime('now');
        $dateauj=$dateauj->format('Ymd');
        $dateevent=$event->getStart()->format('Ymd');

        $vu = $this->Vuevent($event);
        $parti = $em->getRepository("AppBundle:Participation")
            ->Findparti($this->getUser(),$event);

        $nbinvit =  $em->getRepository("AppBundle:Participation")
            ->countinvite($event);
        $nbparticip = $em->getRepository("AppBundle:Participation")
            ->countparticip($event);
        //rating
                /**************** REVIW***************/
         $reviews=$this->listReviwAction($event);
        $review = new Review();
        $qb = $em->createQueryBuilder()->select('COUNT(l)')->from('AppBundle:Review','l')
            ->where('l.event = :event')->setParameter('event',$event);
        $result = $qb->getQuery()->getSingleScalarResult();


        $form2= $this->createForm(ReviewType::class,$review);
        $form2->handleRequest($request);
        if($form2->isSubmitted()){
            $review->setUser($this->getUser());
            $review->setEvent($event);
            $review->setDateajout(new \DateTime('now'));
            $event->setEtoile($this->calculerVote($event,$request)
            );
            $em->persist ($event);
            $em->persist ($review);
            $em->flush();

            return $this->redirectToRoute("evenement_detailRating"
                ,array
                ( "id"=>$id,
                    "events"=>$event,
                    "particip"=> $parti,
                    'users'=>$user,
                    'nbinvit'=>$nbinvit,
                    'nbparticip'=>$nbparticip,
                    'vu'=>$vu,
                    'rev'=>$form2->createView(),
                    'nb'=>$result,
                    'dateauj'=>$dateauj,
                    'dateevent'=>$dateevent,
                    'reviews'=>$reviews));
        }

        return $this->render("@Evenement/Default/detaileventRating.html.twig",array(
            "events"=>$event,
            "particip"=> $parti,
            'users'=>$user,
            'nbinvit'=>$nbinvit,
            'nbparticip'=>$nbparticip,
            'vu'=>$vu,
            'rev'=>$form2->createView(),
            'nb'=>$result,
            'dateauj'=>$dateauj,
            'dateevent'=>$dateevent,
            'reviews'=>$reviews
        ));
    }

    public function calculerVote(Evenement $event, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $x = 0.0;
        $rates = $em->getRepository('AppBundle:Review')->findBy(array('event' => $event));
        foreach ($rates as $rate) {
            $x = $x + $rate->getnote();
        }
        if (count($rates) > 0) {
            $x = $x / count($rates);
        } else {
            $x = 0;
        }
        return round($x);
    }

    public function listReviwAction( $event){
        $em = $this -> getDoctrine()-> getManager();
        $reviw = $em -> getRepository("AppBundle:Review")
            ->FindReviwEvent($event);

        return $reviw;
    }
public function listTopEventAction(){
    $topevent=$this->topEventAction();
    $topetoilrevent=$this->topEtoileEventAction();
    return $this->render('@Evenement/Default/topevent.html.twig'
        ,array(
            "topevent"=>$topevent,
            "topetoilrevent"=>$topetoilrevent
        ));
}


    //////////////////////back admin ///////////////
    public function listnonacteptAction(Request $request){
        $em = $this -> getDoctrine()-> getManager();
        $eventa = $em -> getRepository("AppBundle:Evenement")
            ->FindAcceptedEv();
        $eventNa = $em -> getRepository("AppBundle:Evenement")
            ->FindNonAcceptedEv();
        if ($request -> isMethod('post')){
            $search=$request->get('search');
            $eventa= $em->getRepository("AppBundle:Evenement")
                //   ->findBy(array( 'titre'=>$search ));
                ->FindByName($search);}
        if ($request -> isMethod('post')){
            $search=$request->get('search');
            $event = $em->getRepository("AppBundle:Evenement")
                ->FindAcceptedEv();
        }
        return $this->render('@Evenement/admin/listevent.html.twig'
            ,array(
                "eventNa"=>$eventNa,
                "eventa"=>$eventa,
            ));
    }

    public function AccepteventAction(Request $request){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("AppBundle:Evenement")
            ->find($id);
        $event->setEtat('accepted');
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('evenement_adminlist');
    }
    public function suppeventAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em -> getRepository("AppBundle:Evenement")->find($id);
        //$modele de type objet
        $em ->remove($event);
        $em ->flush();
        return $this->redirectToRoute('evenement_adminlist');
    }

}
