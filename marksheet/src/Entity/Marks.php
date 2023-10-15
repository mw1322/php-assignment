<?php

namespace App\Entity;

use App\Repository\MarksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarksRepository::class)]
class Marks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $MATHS = null;

    #[ORM\Column]
    private ?int $ENGLISH = null;

    #[ORM\Column]
    private ?int $PHYSICS = null;

    #[ORM\Column]
    private ?int $CHEMISTRY = null;

    #[ORM\Column]
    private ?int $BIOLOGY = null;

    #[ORM\ManyToOne(inversedBy: 'marks',)]
    private ?Students $ROLLNO = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMATHS(): ?int
    {
        return $this->MATHS;
    }

    public function setMATHS(int $MATHS): static
    {
        $this->MATHS = $MATHS;

        return $this;
    }

    public function getENGLISH(): ?int
    {
        return $this->ENGLISH;
    }

    public function setENGLISH(int $ENGLISH): static
    {
        $this->ENGLISH = $ENGLISH;

        return $this;
    }

    public function getPHYSICS(): ?int
    {
        return $this->PHYSICS;
    }

    public function setPHYSICS(int $PHYSICS): static
    {
        $this->PHYSICS = $PHYSICS;

        return $this;
    }

    public function getCHEMISTRY(): ?int
    {
        return $this->CHEMISTRY;
    }

    public function setCHEMISTRY(int $CHEMISTRY): static
    {
        $this->CHEMISTRY = $CHEMISTRY;

        return $this;
    }

    public function getBIOLOGY(): ?int
    {
        return $this->BIOLOGY;
    }

    public function setBIOLOGY(int $BIOLOGY): static
    {
        $this->BIOLOGY = $BIOLOGY;

        return $this;
    }

    public function getROLLNO(): ?Students
    {
        return $this->ROLLNO;
    }

    public function setROLLNO(?Students $ROLLNO): static
    {
        $this->ROLLNO = $ROLLNO;

        return $this;
    }
}
