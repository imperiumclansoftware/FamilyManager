<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="info_compte")
 * @ORM\Entity(repositoryClass="App\Repository\InfoCompteRepository")
 * @ORM\Entity
 */
class InfoCompte
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="cle_etablissement", type="integer", length=20, nullable=false, precision=5)
     */
    private $cleEtablissement;

    /**
     * @ORM\Column(name="guichet", type="integer", length=20, nullable=false, precision=5)
     */
    private $guichet;

    /**
     * @ORM\Column(name="num_compte", type="bigint", length=50, nullable=false, precision=11)
     */
    private $numCompte;

    /**
     * @ORM\Column(name="cle_rice", type="integer", length=20, nullable=false, precision=2)
     */
    private $cleRice;

    /**
     * @ORM\Column(name="domiciliation", type="text", length=50, nullable=false)
     */
    private $domiciliation;

    /**
     * @ORM\Column(name="bic", type="text", length=25, nullable=false)
     */
    private $bic;

    /**
     * @ORM\Column(name="iban", type="text", length=100, nullable=false)
     */
    private $iban;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="infoCompte")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Chequier", inversedBy="infoCompte")
     * @ORM\JoinColumn(name="chequier_id", referencedColumnName="id", nullable=false)
     */
    private $chequier;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="infoCompte")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="Solde", inversedBy="infoCompte")
     * @ORM\JoinColumn(name="solde_id", referencedColumnName="id", nullable=false)
     */
    private $solde;

    /**
     * @ORM\ManyToOne(targetEntity="Carte", inversedBy="infoCompte")
     * @ORM\JoinColumn(name="carte_id", referencedColumnName="id", nullable=false)
     */
    private $carte;

    /**
     * @ORM\ManyToOne(targetEntity="Banque", inversedBy="infoCompte")
     * @ORM\JoinColumn(name="banque_id", referencedColumnName="id", nullable=false)
     */
    private $banque;


    //--- Gestion admin ---
    public function __toString()
    {
        return $this->numCompte;
    }

    //--- Le Construc ---
    public function __construct()
    {
        $this->client = new ArrayCollection();
    }


    //--- Les Getters & les Setters ---
    function getId()
    {
        return $this->id;
    }

    function getCleEtablissement()
    {
        return $this->cleEtablissement;
    }

    function getGuichet()
    {
        return $this->guichet;
    }

    function getNumCompte()
    {
        return $this->numCompte;
    }

    function getCleRice()
    {
        return $this->cleRice;
    }

    function getDomiciliation()
    {
        return $this->domiciliation;
    }

    function getBic()
    {
        return $this->bic;
    }

    function getIban()
    {
        return $this->iban;
    }

    function getClient()
    {
        return $this->client;
    }

    function getChequier()
    {
        return $this->chequier;
    }

    function getCategorie()
    {
        return $this->categorie;
    }

    function getSolde()
    {
        return $this->solde;
    }

    function getCarte()
    {
        return $this->carte;
    }

    function getBanque()
    {
        return $this->banque;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setCleEtablissement($cleEtablissement)
    {
        $this->cleEtablissement = $cleEtablissement;
    }

    function setGuichet($guichet)
    {
        $this->guichet = $guichet;
    }

    function setNumCompte($numCompte)
    {
        $this->numCompte = $numCompte;
    }

    function setCleRice($cleRice)
    {
        $this->cleRice = $cleRice;
    }

    function setDomiciliation($domiciliation)
    {
        $this->domiciliation = $domiciliation;
    }

    function setBic($bic)
    {
        $this->bic = $bic;
    }

    function setIban($iban)
    {
        $this->iban = $iban;
    }

    function setClient($client)
    {
        $this->client = $client;
    }

    function setChequier($chequier)
    {
        $this->chequier = $chequier;
    }

    function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    function setSolde($solde)
    {
        $this->solde = $solde;
    }

    function setCarte($carte)
    {
        $this->carte = $carte;
    }

    function setBanque($banque)
    {
        $this->banque = $banque;
    }
}   //--- Fin de InfoCompte