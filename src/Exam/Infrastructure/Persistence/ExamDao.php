<?php

namespace School\Exam\Infrastructure\Persistence;

use School\Exam\Infrastructure\Persistence\ExamDaoRepository;
use School\Exam\Domain\Exam;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamDaoRepository::class)
 * @ORM\Table(name="exam")
 */
class ExamDao
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $courseId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;


    public function __construct(Exam $exam)
    {
        $this->setEntity($exam);
    }


    public function toEntity(): Exam
    {
        return new Exam($this->id, $this->title, $this->courseId);
    }

    public function setEntity(Exam $exam)
    {
        $this->id = $exam->id();
        $this->title = $exam->title();
        $this->courseId = $exam->courseId();
        $this->created = new DateTime();
    }
}
