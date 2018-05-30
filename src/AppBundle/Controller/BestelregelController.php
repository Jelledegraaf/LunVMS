<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Bestelopdracht;
use AppBundle\Entity\Bestelregel;
use AppBundle\Entity\Artikel;
use AppBundle\Form\Type\BestelOpdrachtType;
use AppBundle\Form\Type\BestelregelType;
use AppBundle\Form\Type\ArtikelType;
use AppBundle\Form\Type\OntvangstType;
use AppBundle\Form\Type\NieuwOntvangstType;

class BestelregelController extends Controller
{
/**
     * @Route("/bestelregel/nieuw", name="bestelregelnieuw")
     */
    public function nieuweBestelRegel(Request $request) {
        $nieuweBestelRegel = new Bestelregel();
        $form = $this->createForm(BestelregelType::class, $nieuweBestelRegel);
        $nieuweBestelRegel->setOntvangen(0);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nieuweBestelRegel);
            $em->flush();
            return $this->redirect($this->generateurl("bestelregelnieuw"));
        }

        return new Response($this->renderView('form.html.twig', array('form' => $form->createView())));
    }

    /**
    * @Route("/bestelregel/{bestelordernummer}", name="alleBestelregels")
    */
    public function bestelregelsOpBoNr(Request $request, $bestelordernummer) {
      $bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findByBestelordernummer("$bestelordernummer");

      return new Response($this->render('AlleBestelregels.html.twig', array ('Bestelregels' => $bestelregels)));
      }


          /**
          * @Route("/alleBestelregels/teOntvangen/0", name="teOntvangenBestelregels")
          */
          public function teOnvangenBestelregels(Request $request) {
            $Bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findByontvangen('0');


            return new Response($this->render('NogTeOntvangen.html.twig', array ('Bestelregels' => $Bestelregels)));
            }

            /**
            * @Route("/alleBestelregels/teOntvangen/1", name="ontvangenBestelregels")
            */
            public function ontvangenBestelregels(Request $request) {
              $Bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findByontvangen("1");


              return new Response($this->render('OntvangenBestellingen.html.twig', array ('Bestelregels' => $Bestelregels,  //'artikelen' => .....)));
              }

            /**
            * @Route("/bestelregel/wijzig/{id}", name="ontvangstWijzigen")
            */
            public function wijzigBestelregel(Request $request, $id) {
            $huidigBestelregel = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->find($id);
            $form = $this->createForm(NieuwOntvangstType::class, $huidigBestelregel);

            $form->handleRequest($request);
              if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($huidigBestelregel);
                $em->flush();
                return $this->redirect($this->generateurl("ontvangenBestelregels"));
              }

            return new Response($this->render('form.html.twig', array('form' => $form->createView())));
            }

}
