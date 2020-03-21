<?php
// src/Controller/MainController.php
namespace App\Controller;

use App\Entity\Subject;
use App\Entity\Situation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    public function home()
    {
      // Fetch random subject
      $subject = $this->getDoctrine()
        ->getRepository(Subject::class)
        ->findByRandom();

      // Fetch random situation
      $situation = $this->getDoctrine()
        ->getRepository(Situation::class)
        ->findByRandom();

      return $this->redirectToRoute('idea_show', [
          'subject_id' => $subject->getId(),
          'situation_id' => $situation->getId(),
      ]);
    }

    public function showIdea(Request $request)
    {
      $routeParameters = $request->attributes->get('_route_params');

      // Fetch wanted subject
      $subject = $this->getDoctrine()
        ->getRepository(Subject::class)
        ->find($routeParameters["subject_id"]);

      // Fetch wanted situation
      $situation = $this->getDoctrine()
        ->getRepository(Situation::class)
        ->find($routeParameters["situation_id"]);

      return $this->render('mainpage.html.twig', [
          'subject' => $subject,
          'situation' => $situation,
      ]);
    }
}
