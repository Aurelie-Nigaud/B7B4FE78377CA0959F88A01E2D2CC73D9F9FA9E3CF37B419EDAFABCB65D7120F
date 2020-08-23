<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(
 *      name="grade",
 *      indexes={@ORM\Index(name="grade_id", columns={"id"})}
 * )
 */
class Grade
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var Student
     * @Assert\NotNull(groups={"add"})
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="grades", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn (name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @var Subject
     * @Assert\NotNull(groups={"add"})
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"})
     * @ORM\JoinColumn (name="subject_id", referencedColumnName="id")
     */
    private $subject;

    /**
     * @var Classroom
     * @Assert\NotNull(groups={"add"})
     * @ORM\ManyToOne(targetEntity="Classroom", inversedBy="grades", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn (name="classroom_id", referencedColumnName="id")
     */
    private $classroom;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     * @Assert\Range (
     *     groups={"add"},
     *     min = 0,
     *     max = 20,
     *     notInRangeMessage = "Grade must be between 0 and 20."
     * )
     */
    private $value;

    public function addStudent(Student $student)
    {
        $this->student = $student;
        $this->classroom = $student->getClassroom();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Student|null
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student|null $student
     */
    public function setStudent(?Student $student): void
    {
        $this->student = $student;
    }


    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     */
    public function setSubject(Subject $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return Classroom
     */
    public function getClassroom(): Classroom
    {
        return $this->classroom;
    }

    /**
     * @param Classroom $classroom
     */
    public function setClassroom(Classroom $classroom): void
    {
        $this->classroom = $classroom;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }
}