<?php


namespace App\Course\Application\FindAll;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Course\Application\ListCourseResponse;
use App\Course\Application\CourseResponse;
use App\Course\Domain\CourseRepository;

class FindAllCourseQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllCourseQuery $query): ListCourseResponse
    {
        $Courses = $this->repository->findAll();
        $responses = [];
        foreach ($Courses as $Course){
            $responses[]=new CourseResponse($Course);
        }
        return new ListCourseResponse($responses);
    }
}