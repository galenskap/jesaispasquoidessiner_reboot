<?php
// src/Controller/SubmissionsController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionsController extends AbstractController
{
    public function showDashboard()
    {
        $submissions = "test";
        return $this->render('dashboard.html.twig', [
            'submissions' => $submissions,
        ]);
    }


    public function sendDrawing(Request $request)
    {
        // creates a submission object and initializes some data
        // $submission = new Submission();
        // $submission->status(1);
        // $submission->setDate(new \DateTime('now'));
        //
        // $form = $this->createFormBuilder($submission)
        //     ->add('submission', TextType::class)
        //     ->add('dueDate', DateType::class)
        //     ->add('save', SubmitType::class, ['label' => 'Create Task'])
        //     ->getForm();
    }
}
