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
use AppBundle\Form\Type\ArtikelWijzigMinType;
use AppBundle\Form\Type\ArtikelZoeken;

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

        return new Response($this->render('formNieuwArtikel.html.twig', array('form' => $form->createView())));
    }

    /**
  * @Route ("/artikel/wijzig/{artikelnummer} ", name="wijzigartikel")
  */
 public function wijzigArtikel(Request $request, $artikelnummer){
     $bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
     $form = $this->createForm(ArtikelType::class, $bestaandProduct);

     $form->handleRequest($request);
     if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($bestaandProduct);
         $em->flush();
         return $this->redirect($this->generateurl("wijzigartikel", array("artikelnummer" => $bestaandProduct->getArtikelnummer())));
     }

     return new Response($this->renderView('formWijzigArtikel.html.twig', array('form' => $form->createView())));
 }


 /**
* @Route ("/artikel/wijzigminvoorraad/{artikelnummer} ", name="wijzigminvoorraad")
*/
public function wijzigArtikelMV(Request $request, $artikelnummer){
  $bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
  $form = $this->createForm(ArtikelWijzigMinType::class, $bestaandProduct);

  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaandProduct);
      $em->flush();
      return $this->redirect($this->generateurl("wijzigminvoorraad", array("artikelnummer" => $bestaandProduct->getArtikelnummer())));
  }

  return new Response($this->renderView('formWijzigMinVoorraad.html.twig', array('form' => $form->createView())));
}


  /**
   * @Route ("/artikelen/alle", name="alleartikelen")
   */
  public function alleArtikelen(Request $request){
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();

      return new Response($this->render('artikel.html.twig', array('artikelen' => $artikelen)));
  }


  /**
  * @Route("/artikel/zoeken", name="zoekenartikel")
  */
public function zoekArtikel(Request $request) {

  //  $nieuwArtikel = new Artikel();
    $form = $this->createForm(ArtikelZoeken::class);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $artikel = $form->getData();

        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findBy(
        array('omschrijving'=> $artikel->getOmschrijving())
        );
        return new Response($this->render('zoekresultaat.html.twig', array('artikelen' => $artikelen)));

     }


      return new Response($this->render('zoekformulier.html.twig', array('form' => $form->createView())));
  }


  //public function searchAction(Request $request) {
    //$omschrijving = $request->get('omschrijving');

    //$repository = $this->getDoctrine()->getRepository(Artikel::class);



    //aanpassen naar werkend Formulier
   // return $this->render('.......:search.html.twig'
    //, array('artikelen'=> $artikelen));


  //$em = $this->getDoctrine()->getManager();
  //die();


    // Formulier aanmaken
    //$form = $this->createForm(ArtikelZoeken::class, $nieuwArtikel);

  //  $form->handleRequest($request);

    // Uitvoeren als op zoeken is geklikt
  //  if ($form->isSubmitted() && $form->isValid()) {

        // Data ophalen, omschrijving is ingevuld
      //  $data = $request->request->get('omschrijving');
      //  $em = $this->getDoctrine()->getManager();

        // Query uitvoeren
      //  $query = $em->createQuery('SELECT * FROM `artikel` WHERE `magazijnlocatie` LIKE :data')->setParameter('data',$data);

      //  $resultaat = $query->getResult();

        // Artikel tonen
      //  return $this->render


      //  return $this->redirect($this->generateurl("zoekenartikel"));
    //}

    //return new Response($this->render('form.html.twig', array('form' => $form->createView())));


//  <form method="POST" action="{{ path (' route_naar_zoekfunctie') }}">
//  <input type="text" name="zoekwaarde" />
//  <input type="submit" name="verzendknop" />
//  </form>
//}

}
