<?php

namespace App\Controller;


use App\Shared\Domain\Bus\Command\CommandBus;
use App\Student\Application\Create\CreateStudentCommand;
use App\Student\Application\DeleteStudentById;
use App\Student\Application\FindAllStudent;
use App\Student\Application\FindStudentById;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/students")
 */
class StudentController extends AbstractController
{
    private $findStudentById;
    private $deleteStudentById;
    private $findAllStudent;

    private $commandBus;

    public function __construct(FindStudentById $findStudentById,
                                DeleteStudentById $deleteStudentById,
                                FindAllStudent $findAllStudent,
                                CommandBus $commandBus)
    {
        $this->findStudentById = $findStudentById;
        $this->deleteStudentById = $deleteStudentById;
        $this->findAllStudent = $findAllStudent;
        $this->commandBus = $commandBus;
    }


    /**
     * @Route("/{studentId}", methods={"GET"})
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
     * @Route("", methods={"GET"})
     */
    public function getAll()
    {
        return $this->json(
            $this->findAllStudent->execute()
        );

    }

    /**
     * @Route("/{studentId}", methods={"PUT"})
     */
    public function create(string $studentId, Request $request)
    {
        $this->commandBus->dispatch(
            new CreateStudentCommand(
                $studentId,
                $request->request->get('name', '')
            )
        );
        return new Response('', Response::HTTP_CREATED);

    }


    /**
     * @Route("/{studentId}", methods={"DELETE"})
     */
    public function deleteById(string $studentId)
    {

        $this->deleteStudentById->execute($studentId);
        return new Response('', Response::HTTP_OK);

    }
}