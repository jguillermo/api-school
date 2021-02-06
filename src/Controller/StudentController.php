<?php

namespace App\Controller;


use App\Student\Application\CreateStudent;
use App\Student\Application\FindStudentById;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
    private $findStudentById;
    private $creatorStudent;

    public function __construct(FindStudentById $findStudentById, CreateStudent $creatorStudent)
    {
        $this->findStudentById = $findStudentById;
        $this->creatorStudent = $creatorStudent;
    }


    /**
     * @Route("/student/{studentId}", methods={"GET"})
     */
    public function getById(string $studentId)
    {
        try {
            return $this->json(
                $this->findStudentById->execute($studentId)
            );
        } catch (NotFoundHttpException $exception) {
            return $this->json([
                'error' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * @Route("/student/{studentId}", methods={"PUT"})
     */
    public function creator(string $studentId, Request $request)
    {
        $this->creatorStudent->execute(
                $studentId,
                $request->request->get('name','')
        );
        return new Response('', Response::HTTP_CREATED);

    }
}