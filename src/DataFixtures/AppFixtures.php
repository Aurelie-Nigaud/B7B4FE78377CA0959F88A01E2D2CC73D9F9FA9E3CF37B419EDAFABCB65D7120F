<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use App\Entity\Grade;
use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Subject
        $mathSubject = new Subject();
        $mathSubject->setName("Mathématiques");
        $manager->persist($mathSubject);
        $manager->flush();

        $frSubject = new Subject();
        $frSubject->setName("Français");
        $manager->persist($frSubject);
        $manager->flush();

        $enSubject = new Subject();
        $enSubject->setName("Anglais");
        $manager->persist($frSubject);
        $manager->flush();

        //classrooms
        $sixAclassroom = new Classroom();
        $sixAclassroom->setName("6emA");
        $manager->persist($frSubject);
        $manager->flush();

        $sixBclassroom = new Classroom();
        $sixBclassroom->setName("6emB");
        $manager->persist($frSubject);
        $manager->flush();

        //Student
        $student1 = new Student();
        $student1->setFirstname('Simon');
        $student1->setLastname('Garfunkel');
        $student1->setBirthdate(new \DateTime('2008-06-18T00:00:00+00:00'));
        $student1->setClassroom($sixAclassroom);

        $grade1 =new Grade();
        $grade1->setSubject($frSubject);
        $grade1->setValue(11);

        $grade2 = new Grade();
        $grade2->setSubject($mathSubject);
        $grade2->setValue(12.5);

        $grade3 = new Grade();
        $grade3->setSubject($mathSubject);
        $grade3->setValue(15);

        $grade4 = new Grade();
        $grade4->setSubject($enSubject);
        $grade4->setValue(17);

        $student1->addGrades([$grade1, $grade2, $grade3, $grade4]);
        $manager->persist($student1);

        $student2 = new Student();
        $student2->setFirstname('Bobby');
        $student2->setLastname('McGee');
        $student2->setBirthdate(new \DateTime('2008-06-18T00:00:00+00:00'));
        $student2->setClassroom($sixBclassroom);

        $grade5 =new Grade();
        $grade5->setSubject($frSubject);
        $grade5->setValue(5);

        $grade6 = new Grade();
        $grade6->setSubject($mathSubject);
        $grade6->setValue(19);

        $grade7 = new Grade();
        $grade7->setSubject($mathSubject);
        $grade7->setValue(15);

        $grade8 = new Grade();
        $grade8->setSubject($enSubject);
        $grade8->setValue(8);

        $student2->addGrades([$grade5, $grade6, $grade7, $grade8]);
        $manager->persist($student2);

        $student3 = new Student();
        $student3->setFirstname('Ella');
        $student3->setLastname('Fitzgerald');
        $student3->setBirthdate(new \DateTime('2008-06-18T00:00:00+00:00'));
        $student3->setClassroom($sixBclassroom);

        $grade9 =new Grade();
        $grade9->setSubject($frSubject);
        $grade9->setValue(6);

        $grade10 = new Grade();
        $grade10->setSubject($mathSubject);
        $grade10->setValue(12);

        $grade11 = new Grade();
        $grade11->setSubject($mathSubject);
        $grade11->setValue(11);

        $grade12 = new Grade();
        $grade12->setSubject($enSubject);
        $grade12->setValue(16);

        $student2->addGrades([$grade9, $grade10, $grade11, $grade12]);
        $manager->persist($student2);

        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();

    }
}
