<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassroomRepository")
 * @ORM\Table (
 *     name="classroom",
 *     indexes={@ORM\Index(name="classroom_id", columns={"id"})}
 *)
 */
class Classroom
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany (targetEntity="Student", mappedBy="classroom")
     */
    private $students;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany (targetEntity="Grade", mappedBy="classroom")
     */
    private $grades;

    /**
     * Classroom constructor.
     */
    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents(): ArrayCollection
    {
        return $this->students;
    }

    /**
     * @param ArrayCollection $students
     */
    public function setStudents(ArrayCollection $students): void
    {
        $this->students = $students;
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
     * @use get global average for a classroom
     * @return float|null
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