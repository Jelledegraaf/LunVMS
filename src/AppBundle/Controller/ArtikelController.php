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

class ArtikelController extends Controller
{
/**
     * @Route("/artikel/nieuw", name="nieuwartikel")
     */
    public function nieuwArtikel(Request $request) {
        $nieuwArtikel = new Artikel();
        $form = $this->createForm(ArtikelType::class, $nieuwArtikel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nieuwArtikel);
            $em->flush();
            return $this->redirect($this->generateurl("nieuwartikel"));
        }

        return new Response($this->renderView('form.html.twig', array('form' => $form->createView())));
    }

    /**
  * @Route ("/artikel/wijzigminvoorraad/{artikelnummer} ", name="wijzigminvoorraad")
  */
 public function wijzigArtikelMV(Request $request, $artikelnummer){
     $bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
     $form = $this->createForm(ArtikelType::class, $bestaandProduct);

     $form->handleRequest($request);
     if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($bestaandProduct);
         $em->flush();
         return $this->redirect($this->generateurl("wijzigminvoorraad", array("artikelnummer" => $bestaandProduct->getArtikelnummer())));
     }

     return new Response($this->renderView('form.html.twig', array('form' => $form->createView())));
 }


  /**
   * @Route ("/artikelen/alle", name="alleartikelen")
   */
  public function alleArtikelen(Request $request){
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();

      return new Response($this->render('artikel.html.twig', array('artikelen' => $artikelen)));
  }

}
