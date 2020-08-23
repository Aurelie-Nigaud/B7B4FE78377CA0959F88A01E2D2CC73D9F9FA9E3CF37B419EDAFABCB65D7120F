<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ORM\Table (
 *     name="student",
 *     indexes={@ORM\Index(name="student_id", columns={"id"})}
 *)
 */
class Student
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
     * @var string
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Length(groups={"create", "update"}, min=3, max=100)
     *
     * @ORM\Column (name="lastname", type="string",  length=100)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Length(groups={"create", "update"}, min=3, max=100)
     *
     * @ORM\Column (name="firstname", type="string",  length=100)
     */
    private $firstname;

    /**
     * @var DateTime
     * @Assert\Date
     *
     * @ORM\Column (name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var Classroom
     *
     * @ORM\ManyToOne (targetEntity="Classroom", inversedBy="students", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\JoinColumn (name="classroom_id", referencedColumnName="id")
     */
    private $classroom;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany (targetEntity="Grade", mappedBy="student", cascade={"persist","remove"}, fetch="EXTRA_LAZY")
     *
     */
    private $grades;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->grades = new ArrayCollection();
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
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param DateTime $birthdate
     */
    public function setBirthdate(DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
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
     * @return ArrayCollection
     */
    public function getGrades(): ArrayCollection
    {
        return $this->grades;
    }

    /**
     * @param ArrayCollection $grades
     */
    public function setGrades(ArrayCollection $grades): void
    {
        $this->grades = $grades;
    }

    /**
     * @param array $grades
     */
    public function addGrades(array $grades): void
    {
        array_walk($grades, function ($grade) {
            $grade->setStudent($this);
            $grade->setClassroom($this->getClassroom());
            $this->grades->add($grade);
        });
    }

    /**
     * @use get global average for a student
     * @return int
     */
    public function getGlobalAvg(): ?float
    {
        if (!empty($this->grades)) {
            $sumValue = array_reduce($this->grades->getValues(), function ($sum, Grade $grade) {
                return $sum += $grade->getValue();
            });
            return number_format($sumValue / count($this->grades->getValues()), 1);
        }
        return null;
    }
}