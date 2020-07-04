<?php

namespace MapBundle\Controller;

use MapBundle\Entity\Marker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowMapsController extends Controller
{

    /**
     * @Route("/show", name="show")
     */
    public function ShowAction()
    {
        return $this->render('@Map/ShowMaps/show.html.twig', array(
            // ...
        ));
    }
    /**
     * @Route("/save",  options={"expose"=true}, name="save")
     * @Method({"POST"})
     */
    public function SaveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $marker = new Marker();
        $marker->setName($request->request->get('name'));
        $marker->setLat($request->request->get('lat'));
        $marker->setLng($request->request->get('lng'));
        $marker->setType($request->request->get('type'));
        //$file = $request->request->get('image');

        //$filename = md5(uniqid()) . '.' . $file->guessExtension();
        //$file->move(
        // $this->getParameter('marker_directory'), $filename
      // );
        $marker->setImagemarker($request->request->get('image'));
        $marker->setCreateur($this->getUser());
        $em->persist($marker);
        $em->flush();
        $markers = count($em->getRepository('MapBundle:Marker')->findAll());
        $return = json_encode(['success' => $markers]);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }
    /**
     * @Route("/remove", options={"expose"=true}, name="remove")
     * @Method({"POST"})
     */
    public function RemoveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lat=$request->request->get('lat');
        $lng=$request->request->get('lng');
        $marker = $em->getRepository('MapBundle:Marker')->findOneBy(['lat' => $lat, 'lng' => $lng]);
        if ($marker) {
            if ($marker->getCreateur()== $this->getUser())
            { $em->remove($marker);
            $em->flush();
            } else if($marker->getCreateur()!= $this->getUser()) {
                return new Response('Ne pouver pas supprimer ce marker');
            };
        } else {
            $marker = $em->getRepository('MapBundle:Marker')->find($request->request->get('id'));
            if (!$marker){
                return new Response('error');
            }
            $em->remove($marker);
            $em->flush();
        }
        $markers = count($em->getRepository('MapBundle:Marker')->findAll());
        $return = json_encode(['success' => $markers]);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }
    /**
     * @Route("/all", options={"expose"=true}, name="all")
     * @Method({"GET"})
     */
    public function AllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $markers = $em->getRepository('MapBundle:Marker')->findAll();
        $jsonMarkers = [];
        foreach ($markers as $mark) {
            $jsonMarkers[] = ['id' => $mark->getId() , 'name' => $mark->getName() , 'lat' => $mark->getLat()
                , 'lng' => $mark->getLng(),'type'=>$mark->getType() , 'image'=>$mark->getImagemarker()];
        }
        $return = json_encode($jsonMarkers);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }
}
