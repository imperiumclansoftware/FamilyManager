<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="type_compte")
 * @ORM\Entity(repositoryClass="App\Repository\TypeCompteRepository")
 * @ORM\Entity
 */
class TypeCompte
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="type", type="text", length=100, nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(name="interet", type="integer", length=50, nullable=true)
     */
    private $interet;

    /**
     * @ORM\Column(name="carte", type="boolean", nullable=true)
     */
    private $carte;

    /**
     * @ORM\Column(name="chequier", type="boolean", nullable=true)
     */
    private $chequier;

    /**
     * @ORM\OneToMany(targetEntity="Banque", mappedBy="typeCompte")
     */
    private $banque;


    //--- Gestion admin ---
    public function __toString()
    {
        return $this->type . ' ' . $this->interet . ' ' . $this->carte . ' ' . $this->chequier;
    }


    //--- Le Construc ---
    public function __construct()
    {
        $this->banque = new ArrayCollection();
    }


    //--- Les Getters & les Setters ---
    function getId()
    {
        return $this->id;
    }

    function getType()
    {
        return $this->type;
    }

    function getInteret()
    {
        return $this->interet;
    }

    function getCarte()
    {
        return $this->carte;
    }

    function getChequier()
    {
        return $this->chequier;
    }

    function getBanque()
    {
        return $this->banque;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function setInteret($interet)
    {
        $this->interet = $interet;
    }

    function setCarte($carte)
    {
        $this->carte = $carte;
    }

    function setChequier($chequier)
    {
        $this->chequier = $chequier;
    }

    function setBanque($banque)
    {
        $this->banque = $banque;
    }
}   //--- Fin de TypeCompte