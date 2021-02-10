<?php


namespace App\Grade\Application\FindGrade;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Grade\Application\GradeResponse;
use App\Grade\Domain\Grade;
use App\Grade\Domain\GradeRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindGradeByIdQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindGradeByIdQuery $query): GradeResponse
    {
        $grade = $this->repository->findById($query->id);
        if($grade == null){
            throw new NotFoundHttpException("Grade not found");
        }
        return new GradeResponse($grade);
    }
}