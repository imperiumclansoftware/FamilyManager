<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="carte")
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 * @ORM\Entity
 */
class Carte
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="num_carte", type="bigint", length=200, nullable=true)
     */
    private $numCarte;

    /**
     * @ORM\Column(name="date_carte", type="date", nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $dateCarte;

    /**
     * @ORM\OneToMany(targetEntity="InfoCompte", mappedBy="carte")
     */
    private $infoCompte;

    //--- Gestion Admin
    public function __toString()
    {
        return $this->numCarte;
    }

    //--- Le Construc ---
    public function __construct()
    {
        $this->infoCompte = new ArrayCollection();
    }


    //--- Les Getters & les Setters ---
    function getId()
    {
        return $this->id;
    }

    function getNumCarte()
    {
        return $this->numCarte;
    }

    function getDateCarte()
    {
        return $this->dateCarte;
    }

    function getInfoCompte()
    {
        return $this->infoCompte;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNumCarte($numCarte)
    {
        $this->numCarte = $numCarte;
    }

    function setDateCarte($dateCarte)
    {
        $this->dateCarte = $dateCarte;
    }

    function setInfoCompte($infoCompte)
    {
        $this->infoCompte = $infoCompte;
    }
}   //--- Fin de Carte