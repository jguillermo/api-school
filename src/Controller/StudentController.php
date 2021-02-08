<?php

namespace App\Controller;


use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Student\Application\Create\CreateStudentCommand;
use App\Student\Application\Delete\DeleteStudentByIdCommand;
use App\Student\Application\DeleteStudentByIdCommandHandler;
use App\Student\Application\FindAll\FindAllStudentQuery;
use App\Student\Application\FindAllStudent;
use App\Student\Application\FindStudent\FindStudentByIdQuery;
use App\Student\Application\FindStudentById;
use App\Student\Application\ListStudentResponse;
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

    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


    /**
     * @Route("/{studentId}", methods={"GET"})
     */
    public function getById(string $studentId)
    {
        try {
            return $this->json(
                $this->queryBus->ask(new FindStudentByIdQuery($studentId))
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
        /** @var ListStudentResponse $response */
        $response = $this->queryBus->ask(new FindAllStudentQuery());
        return $this->json($response->students);
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
        $this->commandBus->dispatch(
            new DeleteStudentByIdCommand(
                $studentId
            )
        );
        return new Response('', Response::HTTP_OK);

    }
}