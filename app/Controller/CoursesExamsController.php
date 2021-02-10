<?php

namespace App\Controller;


use School\Course\Application\FindCourse\FindCourseByIdQuery;
use School\Exam\Application\Create\CreateExamCommand;
use School\Exam\Application\Delete\DeleteExamByIdCommand;
use School\Exam\Application\FindAll\FindAllExamQuery;
use School\Exam\Application\FindExam\FindExamByIdQuery;
use School\Exam\Application\ListExamResponse;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/courses/{courseId}/exams")
 */
class CoursesExamsController extends AbstractController
{

    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/{examId}", methods={"GET"})
     */
    public function getById(string $courseId, string $examId)
    {
        try {
            return $this->json(
                $this->queryBus->ask(new FindExamByIdQuery($examId, $courseId))
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
    public function getAll(string $courseId)
    {
        try {
            /** @var ListExamResponse $response */
            $response = $this->queryBus->ask(new FindAllExamQuery($courseId));
            return $this->json($response->exams);
        } catch (NotFoundHttpException $exception) {
            return $this->json([
                'error' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * @Route("/{examId}", methods={"PUT"})
     */
    public function create(string $courseId, string $examId, Request $request)
    {
        try {
            $this->commandBus->dispatch(
                new CreateExamCommand(
                    $examId,
                    $request->request->get('title', ''),
                    $courseId
                )
            );
            return new Response('', Response::HTTP_CREATED);
        } catch (NotFoundHttpException $exception) {
            return $this->json([
                'error' => $exception->getMessage()
            ], 404);
        }

    }

    /**
     * @Route("/{examId}", methods={"DELETE"})
     */
    public function deleteById(string $courseId,string $examId)
    {
        try {
            $this->commandBus->dispatch(
                new DeleteExamByIdCommand(
                    $examId,
                    $courseId
                )
            );
            return new Response('', Response::HTTP_OK);
        } catch (NotFoundHttpException $exception) {
            return $this->json([
                'error' => $exception->getMessage()
            ], 404);
        }
    }
}