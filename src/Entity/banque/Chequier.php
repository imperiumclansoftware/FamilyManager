<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="chequier")
 * @ORM\Entity(repositoryClass="App\Repository\ChequierRepository")
 * @ORM\Entity
 */
class Chequier
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="chequier", type="string", nullable=true)
     */
    private $chequier;

    /**
     * @ORM\Column(name="date_chequier", type="date", nullable=true)
     */
    private $dateChequier;

    /**
     * @ORM\Column(name="debut_num", type="integer", length=100, nullable=true)
     */
    private $debutNum;

    /**
     * @ORM\Column(name="fin_num", type="integer", length=100, nullable=true)
     */
    private $finNum;

    /**
     * @ORM\OneToMany(targetEntity="InfoCompte", mappedBy="chequier")
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

    function getChequier()
    {
        return $this->chequier;
    }

    function getDateChequier()
    {
        return $this->dateChequier;
    }

    function getDebutNum()
    {
        return $this->debutNum;
    }

    function getFinNum()
    {
        return $this->finNum;
    }

    function getInfoCompte()
    {
        return $this->infoCompte;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setChequier($chequier)
    {
        $this->chequier = $chequier;
    }

    function setDateChequier($dateChequier)
    {
        $this->dateChequier = $dateChequier;
    }

    function setDebutNum($debut_num)
    {
        $this->debut_num = $debut_num;
    }

    function setFinNum($finNum)
    {
        $this->finNum = $finNum;
    }

    function setInfoCompte($infoCompte)
    {
        $this->infoCompte = $infoCompte;
    }
}   //--- Fin de Chequier