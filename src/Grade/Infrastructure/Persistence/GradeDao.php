<?php

namespace App\Grade\Infrastructure\Persistence;

use App\Grade\Domain\Exam;
use App\Grade\Infrastructure\Persistence\GradeDaoRepository;
use App\Grade\Domain\Grade;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GradeDaoRepository::class)
 * @ORM\Table(name="grade")
 */
class GradeDao
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $examId;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $examStudentId;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $examCourseId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;


    public function __construct(Grade $grade)
    {
        $this->setEntity($grade);
    }


    public function toEntity(): Grade
    {
        return new Grade(
            $this->id,
            $this->grade,
            new Exam(
                $this->examId,
                $this->examStudentId,
                $this->examCourseId)
        );
    }

    public function setEntity(Grade $grade)
    {
        $this->id = $grade->id();
        $this->grade = $grade->grade();
        $this->examId = $grade->exam()->examId();
        $this->examStudentId = $grade->exam()->studentId();
        $this->examCourseId = $grade->exam()->courseId();
        $this->updated = new DateTime();
    }
}
