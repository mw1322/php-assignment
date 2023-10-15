<?php

namespace App\Repository;

use App\Entity\Students;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentsRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Students::class);
        $this->manager = $manager;
    }

    public function fetchData($rollno)
    {
        // Define an array to store all subjects' marks
        $allMarks = [];
        $totalMarks;
        $students = $this->manager->getRepository(Students::class)->findOneBy(['ROLLNO' => $rollno]);
        // $percent = $marks->percent();
        // $passfail = $marks->calculateGrade($percent);
        $marks = $students->getMarks(); // This returns a collection of Marks

        $data = [
            'info' => [
                'rollno' => $students->getROLLNO(),
                'name' => $students->getNAME(),
                'dob' => $students->getDOB(),
                'fname' => $students->getFATHERNAME(),
            ]
        ];
        foreach ($marks as $mark) {
            $marksArray = [
                'math' => $mark->getMATHS(),
                'english' => $mark->getENGLISH(),
                'physics' => $mark->getPHYSICS(),
                'chemistry' => $mark->getCHEMISTRY(),
                'biology' => $mark->getBIOLOGY(),
            ];            // Do something with $mathsScore
            $totalMarks = $mark->getMATHS() + $mark->getENGLISH() + $mark->getPHYSICS() + $mark->getCHEMISTRY()
                + $mark->getBIOLOGY();
            $allMarks[] = $marksArray;
        }

        $grade  = [
            'eng_grade' => $this->calculateGrade($allMarks[0]['english']),
            'math_grade' => $this->calculateGrade($allMarks[0]['math']),
            'phy_grade' => $this->calculateGrade($allMarks[0]['physics']),
            'bio_grade' => $this->calculateGrade($allMarks[0]['biology']),
            'chem_grade' => $this->calculateGrade($allMarks[0]['chemistry']),
        ];
        $data += [
            'marks' => $marksArray,
            'grade' => $grade,
            'total' => $totalMarks,
            'percent' => $this->percent($totalMarks),
            'grades' => $this->overallGrade($this->percent($totalMarks)),
            'passfail' => $this->calculateResult($totalMarks, 300)
        ];
        // echo $allMarks[0]['math'];
        // echo $totalMarks;

        return $data;
        //  [
        // 'rollno' => $students->getROLLNO(),
        // 'name' => $students->getNAME(),
        // 'dob' => $students->getDOB(),
        // 'fname' => $students->getFATHERNAME(),
        // 'math' => $allMarks[0]['MATHS'],
        // 'english' => $allMarks[0]['ENGLISH'],
        // 'physics' => $allMarks[0]['PHYSICS'],
        // 'chemistry' => $allMarks[0]['CHEMISTRY'],
        // 'biology' => $allMarks[0]['BIOLOGY'],
        // 'percent' => $percent,
        // 'grades' => $marks->overallGrade($percent),
        // 'eng_grade' => $marks->calculateGrade($marks->getENGLISH()),
        // 'math_grade' => $marks->calculateGrade($marks->getMATHS()),
        // 'phy_grade' => $marks->calculateGrade($marks->getPHYSICS()),
        // 'bio_grade' => $marks->calculateGrade($marks->getBIOLOGY()),
        // 'chem_grade' => $marks->calculateGrade($marks->getCHEMISTRY()),
        // 'passfail' => $passfail

        // ];
    }
    function calculateResult($obtainedMarks, $totalPassingMarks)
    {
        if ($obtainedMarks > $totalPassingMarks) {
            return 'Pass';
        } else {
            return 'Fail';
        }
    }
    public function percent($total)
    {
        // $total = $this->ENGLISH + $this->BIOLOGY + $this->MATHS + $this->CHEMISTRY + $this->PHYSICS;
        return ($total / 5);
    }

    public  function calculateGrade($marksObtained)
    {
        $gradeBoundaries = [
            90 => 'O',
            80 => 'A+',
            70 => 'A',
            60 => 'B+',
            50 => 'B',
            35 => 'C+',
            0 => 'F'
        ];

        foreach ($gradeBoundaries as $boundary => $grade) {
            if ($marksObtained >= $boundary) {
                return $grade;
            }
        }

        return 'F';
    }
    function overallGrade($percentage)
    {
        $gradeBoundaries = [
            90 => 'O',
            80 => 'A+',
            70 => 'A',
            60 => 'B+',
            50 => 'B',
            35 => 'C+',
            0 => 'F'
        ];

        foreach ($gradeBoundaries as $boundary => $grade) {
            if ($percentage >= $boundary) {
                return $grade;
            }
        }

        return 'F';
    }

    //    /**
    //     * @return Student[] Returns an array of Student objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Student
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
