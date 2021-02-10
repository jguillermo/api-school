<?php

namespace School\Grade\Infrastructure\Persistence;

use School\Grade\Domain\Exam;
use School\Grade\Domain\Grade;
use School\Grade\Domain\GradeRepository;
use School\Grade\Infrastructure\Persistence\GradeDao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MongoDB\BSON\Type;

/**
 * @method GradeDao|null find($id, $lockMode = null, $lockVersion = null)
 * @method GradeDao|null findOneBy(array $criteria, array $orderBy = null)
 * @method GradeDao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GradeDaoRepository extends ServiceEntityRepository implements GradeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GradeDao::class);
    }

    public function persist(Grade $grade): void
    {
        $gradeDao = $this->find($grade->id());
        if ($gradeDao == null) {
            $gradeDao = new GradeDao($grade);
        }else{
            $gradeDao->setEntity($grade);
        }
        $this->getEntityManager()->persist($gradeDao);
        $this->getEntityManager()->flush();
    }

    public function findById(string $id): ?Grade
    {
        $gradeDao = $this->find($id);
        if ($gradeDao == null) {
            return null;
        }
        return $gradeDao->toEntity();
    }

    public function findAll()
    {
        $list = [];
        foreach ($this->findBy([]) as $dao) {
            $list[] = $dao->toEntity();
        }
        return $list;
    }

    public function remove(string $id): void
    {
        $gradeDao = $this->find($id);
        if ($gradeDao !== null) {
            $this->getEntityManager()->remove($gradeDao);
            $this->getEntityManager()->flush();
        }

    }

    /**
     * @param string $type
     * @param $id
     * @return Grade[]
     */
    public function findAllByType(string $type, string $id)
    {
        $list = [];
        $column= 'id';
        if($type == Exam::STUDENT){
            $column= 'examStudentId';
        }
        if($type == Exam::COURSE){
            $column= 'examCourseId';
        }
        if($type == Exam::EXAM){
            $column= 'examId';
        }
        foreach ($this->findBy([$column=>$id]) as $dao) {
            $list[] = $dao->toEntity();
        }
        return $list;
    }
}
