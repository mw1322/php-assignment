<?php

namespace App\Controller;

use App\Form\Rollno;
use App\Form\RollnoType;
use App\Repository\StudentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarkController extends AbstractController
{
    private $studentRepository;

    public function __construct(StudentsRepository $studentRepository)
    {

        $this->studentRepository = $studentRepository;
    }

    /** 
     *@Route("/mark", name = "mark")
     *@param Request $request
     *@return Response
     */
    public function index(Request $request): Response
    {

        $roll = new Rollno();
        $rollform = $this->createForm(RollnoType::class, $roll);
        $rollform->handleRequest($request);

        if ($rollform->isSubmitted() && $rollform->isValid()) {

            $data = $rollform->getData();
            $marks = $this->studentRepository->fetchData($data->rollno);
            $result = $marks;



            return $this->render('success/index.html.twig', ['data' => $result]);
        }



        return $this->render('task/index.html.twig', [
            'rollno_form' => $rollform->createView()
        ]);
    }
    /**
     * @Route("/home", name="new_action")
     */
    public function newAction(Request $request): Response
    {
        // Your logic for the new action here

        return $this->render('home/index.html.twig', [
            'controller_name' => 'MarkController',
        ]);
    }
}
