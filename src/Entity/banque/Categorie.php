<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="nom_categorie", type="text", length=200, nullable=false)
     */
    private $nomCategorie;

    /**
     * @ORM\OneToMany(targetEntity="InfoCompte", mappedBy="categorie")
     */
    private $infoCompte;

    /**
     * @ORM\ManyToOne(targetEntity="SousCategorie", inversedBy="categorie")
     * @ORM\JoinColumn(name="sous_categorie_id", referencedColumnName="id", nullable=false)
     */
    private $sousCategorie;

    //--- Gestion Admin ---
    public function __toString()
    {
        return $this->getNomCategorie();
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

    function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    function getInfoCompte()
    {
        return $this->infoCompte;
    }

    function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom_categorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;
    }

    function setInfoCompte($infoCompte)
    {
        $this->infoCompte = $infoCompte;
    }

    function setSousCategorie($sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;
    }
}   //--- Fin de Categorie