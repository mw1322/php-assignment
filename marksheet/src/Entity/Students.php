<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ROLLNO = null;

    #[ORM\Column(length: 255)]
    private ?string $NAME = null;

    #[ORM\Column(length: 255)]
    private ?string $FATHER_NAME = null;

    #[ORM\OneToMany(mappedBy: 'ROLLNO', targetEntity: Marks::class)]
    private Collection $marks;

    #[ORM\Column(length: 255)]
    private ?string $DOB = null;

    public function __construct()
    {
        $this->marks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getROLLNO(): ?int
    {
        return $this->ROLLNO;
    }

    public function setROLLNO(int $ROLLNO): static
    {
        $this->ROLLNO = $ROLLNO;

        return $this;
    }

    public function getNAME(): ?string
    {
        return $this->NAME;
    }

    public function setNAME(string $NAME): static
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getFATHERNAME(): ?string
    {
        return $this->FATHER_NAME;
    }

    public function setFATHERNAME(string $FATHER_NAME): static
    {
        $this->FATHER_NAME = $FATHER_NAME;

        return $this;
    }

    /**
     * @return Collection<int, Marks>
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Marks $mark): static
    {
        if (!$this->marks->contains($mark)) {
            $this->marks->add($mark);
            $mark->setROLLNO($this);
        }

        return $this;
    }

    public function removeMark(Marks $mark): static
    {
        if ($this->marks->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getROLLNO() === $this) {
                $mark->setROLLNO(null);
            }
        }

        return $this;
    }

    public function getDOB(): ?string
    {
        return $this->DOB;
    }

    public function setDOB(string $DOB): static
    {
        $this->DOB = $DOB;

        return $this;
    }
}
