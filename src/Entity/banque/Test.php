<?php

namespace App\Entity\banque;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $string;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $toto;


    //--- Le Construc ---
    public function __construct()
    {
        //---    Pas de MtoM et de OtoM
    }


    //--- Les Getters & les Setters ---
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getString(): ?\DateTimeInterface
    {
        return $this->string;
    }

    public function setString(?\DateTimeInterface $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getToto(): ?string
    {
        return $this->toto;
    }

    public function setToto(string $toto): self
    {
        $this->toto = $toto;

        return $this;
    }
}
