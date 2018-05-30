<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Ontvangst;
use AppBundle\Form\Type\OntvangstType;
use AppBundle\Entity\Bestelopdracht;
use AppBundle\Entity\Bestelregel;
use AppBundle\Form\Type\BestelOpdrachtType;
use AppBundle\Form\Type\BestelregelType;

class OntvangstController extends Controller

{

  /**
  * @Route("/ontvangst/nieuw", name="ontvangstnieuw")
  */
  public function nieuweOntvangst(Request $request) {
      $nieuweOntvangst = new Ontvangst();
      $form = $this->createForm(ontvangstType::class, $nieuweOntvangst);


      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($nieuweOntvangst);
          $em->flush();
          return $this->redirect($this->generateurl("ontvangstnieuw"));
      }

      return new Response($this->renderView('form.html.twig', array('form' => $form->createView())));
  }

  /**
   * @Route("/ontvangst/wijzig/{id}", name="bestelregelOntvangst")
   */
  public function ontvangstToevoegen(Request $request, $id) {
  $ontvangst = new Ontvangst();
      $form = $this->createForm(ontvangstType::class, $nieuweOntvangst);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($nieuweOntvangst);
          $em->flush();
      return $this->redirect($this->generateurl("/"));
      }

    return new Response($this->renderView('form.html.twig', array('form' => $form->createView())));
}

  /**
   * @Route ("/ontvangst/alle", name="alleontvangsten")
   */
  public function alleOntvangsten(Request $request){
      $ontvangsten = $this->getDoctrine()->getRepository("AppBundle:Ontvangst")->findAll();

      return new Response($this->render('ontvangst.html.twig', array('ontvangsten' => $ontvangsten)));
  }

  /**
   * @Route ("/ontvangst/teontvangen/{ontvangen}", name="teontvangen")
   */
  public function teOntvangen(Request $request, $ontvangen){
      $ontvangsten = $this->getDoctrine()->getRepository("AppBundle:Ontvangst")->findByontvangen($ontvangen);

      return new Response($this->render('teontvangen.html.twig', array('ontvangsten' => $ontvangsten)));
  }
}
