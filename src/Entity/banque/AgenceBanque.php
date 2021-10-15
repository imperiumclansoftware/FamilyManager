<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="agence_banque")
 * @ORM\Entity(repositoryClass="App\Repository\AgenceBanqueRepository")
 * @ORM\Entity
 */
class AgenceBanque
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="agence", type="string", length=50, nullable=false)
     */
    private $agence;

    /**
     * @ORM\Column(name="num_voie", type="string", length=20, nullable=false)
     */
    private $numVoie;

    /**
     * @ORM\Column(name="voie", type="string", length=200, nullable=false)
     */
    private $voie;

    /**
     * @ORM\Column(name="cp", type="integer", length=20, nullable=false, precision=5)
     */
    private $cp;

    /**
     * @ORM\Column(name="ville", type="string", length=200, nullable=false)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="Banque", mappedBy="agenceBanque")
     */
    private $banque;

    /**
     * @ORM\ManyToOne(targetEntity="TypeCompte", inversedBy="agenceBanque")
     * @ORM\JoinColumn(name="type_comspte_id", referencedColumnName="id", nullable=false)
     */
    private $typeCompte;
    /**
     * @ORM\OneToMany(targetEntity="InfoCompte", mappedBy="agenceBanque")
     */
    private $infoCompte;


    //--- Gestion admin ---
    public function __toString()
    {
        return $this->numVoie . ' ' . $this->voie . ' ' . $this->cp . ' ' . $this->ville;
    }

    //--- Le Construc ---
    public function __construct()
    {
        $this->banque = new ArrayCollection();
        $this->infoCompte = new ArrayCollection();
    }



    //--- Les Getters & les Setters ---


    function getId()
    {
        return $this->id;
    }
    function getAgence()
    {
        return $this->agence;
    }
    function getNumVoie()
    {
        return $this->numVoie;
    }

    function getVoie()
    {
        return $this->voie;
    }

    function getCp()
    {
        return $this->cp;
    }

    function getVille()
    {
        return $this->ville;
    }

    function getBanque()
    {
        return $this->banque;
    }
    function getTypeCompte()
    {
        return $this->typeCompte;
    }
    function getInfoCompte()
    {
        return $this->infoCompte;
    }


    function setId($id)
    {
        $this->id = $id;
    }
    function setAgence($agence)
    {
        $this->id = $agence;
    }

    function setNumVoie($numVoie)
    {
        $this->numVoie = $numVoie;
    }

    function setVoie($voie)
    {
        $this->voie = $voie;
    }

    function setCp($cp)
    {
        $this->cp = $cp;
    }

    function setVille($ville)
    {
        $this->ville = $ville;
    }

    function setBanque($banque)
    {
        $this->banque = $banque;
    }
    function setTypeCompte($typeCompte)
    {
        $this->typeCompte = $typeCompte;
    }
    function setInfoCompte($infoCompte)
    {
        $this->infoCompte = $infoCompte;
    }
   

}	//--- fin de AdresseBanque