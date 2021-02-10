<?php

namespace App\Enrollment\Infrastructure\Persistence;

use App\Course\Domain\Course;
use App\Course\Infrastructure\Persistence\CourseDao;
use App\Enrollment\Domain\Enrollment;
use App\Enrollment\Domain\EnrollmentRepository;
use App\Enrollment\Infrastructure\Persistence\EnrollmentDao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnrollmentDao|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnrollmentDao|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnrollmentDao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnrollmentDaoRepository extends ServiceEntityRepository implements EnrollmentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnrollmentDao::class);
    }

    public function persist(Enrollment $enrollment): void
    {
        $dao = $this->findOneBy([
            'studentId' => $enrollment->studentId(),
            'courseId' => $enrollment->courseId()
        ]);
        if($dao!== null){
            return;
        }
        $this->getEntityManager()->persist(new EnrollmentDao($enrollment));
        $this->getEntityManager()->flush();
    }

    public function findByStudentId(string $id)
    {
        $listIds = [];
        foreach ($this->findBy(['studentId' => $id]) as $dao) {
            $listIds[] = $dao->getCourseId();
        }
        $rs= $this->getEntityManager()
            ->createQueryBuilder()
            ->select("c")
            ->from(CourseDao::class,"c")
            ->andWhere('c.id IN (:ids)')
            ->setParameter('ids', $listIds)
            ->getQuery()
            ->getResult()
        ;

        $list = [];
        foreach ($rs as $course){
            $list[]=[
                'id'=>$course->getId(),
                'name'=>$course->getname(),
            ];
        }
        return $list;
    }

    public function deleteAllByCourseId($courseId)
    {
        $enrollments = $this->findBy(['courseId' => $courseId]);
        foreach ($enrollments as $dao) {
            $this->getEntityManager()->remove($dao);
        }
        $this->getEntityManager()->flush();
    }

    public function findByCourse($courseId)
    {
        $list = [];
        foreach ($this->findBy(['courseId' => $courseId]) as $dao) {
            $list[] = $dao->toEntity();
        }
        return $list;
    }
}
