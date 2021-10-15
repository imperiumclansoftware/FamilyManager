<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="solde")
 * @ORM\Entity(repositoryClass="App\Repository\SoldeRepository")
 * @ORM\Entity
 */
class Solde
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="positif", type="bigint", length=50, nullable=true, scale=2)
     */
    private $positif;

    /**
     * @ORM\Column(name="negatif", type="bigint", length=50, nullable=true, scale=2)
     */
    private $negatif;

    /**
     * @ORM\Column(name="solde", type="bigint", length=50, nullable=true, scale=2)
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity="InfoCompte", mappedBy="solde")
     */
    private $infoCompte;



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

    function getPositif()
    {
        return $this->positif;
    }

    function getNegatif()
    {
        return $this->negatif;
    }

    function getSolde()
    {
        return $this->solde;
    }

    function getInfoCompte()
    {
        return $this->infoCompte;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setPositif($positif)
    {
        $this->positif = $positif;
    }

    function setNegatif($negatif)
    {
        $this->negatif = $negatif;
    }

    function setSolde($solde)
    {
        $this->solde = $solde;
    }

    function setInfoCompte($infoCompte)
    {
        $this->infoCompte = $infoCompte;
    }
}   //--- Fin de Solde