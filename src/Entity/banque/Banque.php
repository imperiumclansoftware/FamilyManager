<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="banque")
 * @ORM\Entity(repositoryClass="App\Repository\BanqueRepository")
 * @ORM\Entity
 */
class Banque
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $etablissement;

    /**
     * @ORM\Column(type="object", length=200, nullable=true)
     */
    private $logo;


    /**
     * @ORM\ManyToOne(targetEntity="AgenceBanque", inversedBy="banque")
     * @ORM\JoinColumn(name="adresse_banque_id", referencedColumnName="id", nullable=true)
     */
    private $agenceBanque;

 

    //--- Gestion admin ---
    public function __toString()
    {
        return $this->etablissement . ' ' . $this->logo;
    }



    //--- Les Getters & les Setters ---
    function getId()
    {
        return $this->id;
    }

    function getEtablissement()
    {
        return $this->etablissement;
    }

    function getLogo()
    {
        return $this->logo;
    }

 
    function getAgenceBanque()
    {
        return $this->agenceBanque;
    }



    function setId($id)
    {
        $this->id = $id;
    }

    function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;
    }

    function setLogo($logo)
    {
        $this->logo = $logo;
    }

 

    function setAgenceBanque($agenceBanque)
    {
        $this->agenceBanque = $agenceBanque;
    }

  
}   //--- fn de Banque