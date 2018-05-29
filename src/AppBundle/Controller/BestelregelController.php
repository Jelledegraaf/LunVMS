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

class BestelregelController extends Controller
{
/**
     * @Route("/bestelregel/nieuw", name="bestelregelnieuw")
     */
    public function nieuweBestelRegel(Request $request) {
        $nieuweBestelRegel = new Bestelregel();
        $form = $this->createForm(BestelregelType::class, $nieuweBestelRegel);

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


}
