<?php

namespace App\Service\Student;

use App\Entity\Grade;
use App\Entity\Student;
use App\Entity\Subject;
use App\Service\Student\AddStudentGradeService\Dto\AddStudentGradeDTO;
use App\Service\Student\AddStudentGradeService\Dto\AddSubjectGradeSubjectDTO;
use App\Service\Student\CreateStudentService\Dto\CreateStudentDTO;
use App\Service\Student\GetStudentGlobalAvgService\Dto\StudentGlobalAverageDTO;
use App\Service\Student\UpdateStudentService\Dto\UpdateStudentDTO;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\CustomMapper\CustomMapper;
use AutoMapperPlus\MappingOperation\Operation;
use DateTime;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class StudentAutoMapperConfig
 * @package App\Service\Student
 */
class StudentAutoMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        // Create Student
        $config->registerMapping(CreateStudentDTO::class, Student::class)
            ->forMember('firstname', function (CreateStudentDTO $student) {
                return ucfirst($student->getFirstname());
            })
            ->forMember('lastname', function (CreateStudentDTO $student) {
                return ucfirst($student->getLastname());
            })
            ->forMember("birthdate", function (CreateStudentDTO $student) {
                return new DateTime($student->getBirthdate());
            });
        //Update Student
        $config->registerMapping(UpdateStudentDTO::class, Student::class)
            ->forMember('firstname', function (UpdateStudentDTO $student) {
                return ucfirst($student->getFirstname());
            })
            ->forMember('lastname', function (UpdateStudentDTO $student) {
                return ucfirst($student->getLastname());
            })
            ->forMember("birthdate", function (UpdateStudentDTO $student) {
                return new DateTime($student->getBirthdate());
            });
        //addStudentGrade
        $config->registerMapping(AddStudentGradeDTO::class, Grade::class);
    }

}