<?php

namespace App\Enrollment\Infrastructure\Persistence;

use App\Enrollment\Infrastructure\Persistence\EnrollmentDaoRepository;
use App\Enrollment\Domain\Enrollment;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentDaoRepository::class)
 * @ORM\Table(name="enrollment")
 */
class EnrollmentDao
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private $studentId;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private $courseId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->courseId;
    }



    public function __construct(Enrollment $enrollment)
    {
        $this->studentId = $enrollment->studentId();
        $this->courseId = $enrollment->courseId();
        $this->created = new DateTime();
    }


    public function toEntity():Enrollment
    {
        return new Enrollment($this->id,$this->name);
    }

}
