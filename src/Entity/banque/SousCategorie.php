<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sous_categorie")
 * @ORM\Entity(repositoryClass="App\Repository\SousCategorieRepository")
 * @ORM\Entity
 */
class SousCategorie
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="nom_sous_categorie", type="text", length=200, nullable=false)
     */
    private $nomSousCategorie;

    /**
     * @ORM\OneToMany(targetEntity="Categorie", mappedBy="sousCategorie")
     */
    private $categorie;

    //--- Gestion Admin ---
    public function __toString()
    {
        return $this->getNomSousCategorie();
    }

    //--- Le Construc ---
    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }


    //--- Les Getters & les Setters ---
    function getId()
    {
        return $this->id;
    }

    function getNomSousCategorie()
    {
        return $this->nomSousCategorie;
    }

    function getCategorie()
    {
        return $this->categorie;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNomSousCategorie($nomSousCategorie)
    {
        $this->nomSousCategorie = $nomSousCategorie;
    }

    function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}   //--- Fin de SousCategorie