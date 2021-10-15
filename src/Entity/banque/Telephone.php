<?php
namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="telephone")
 * @ORM\Entity(repositoryClass="App\Repository\TelephoneRepository")
 * @ORM\Entity
 */
class Telephone
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="telephone_detenteur1", type="integer", length=50, nullable=false)
     */
    private $telephoneDetenteur1;

    /**
     * @ORM\Column(name="telephone_detenteur2", type="integer", length=50, nullable=true)
     */
    private $telephoneDetenteur2;

    /**
     * @ORM\Column(name="telephone_pro1", type="integer", length=50, nullable=true)
     */
    private $telephonePro1;

    /**
     * @ORM\Column(name="telephone_pro2", type="integer", length=50, nullable=true)
     */
    private $telephonePro2;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="telephone")
     */
    private $client;



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

    function getTelephoneDetenteur1()
    {
        return $this->telephoneDetenteur1;
    }

    function getTelephoneDetenteur2()
    {
        return $this->telephoneDetenteur2;
    }

    function getTelephonePro1()
    {
        return $this->telephonePro1;
    }

    function getTelephonePro2()
    {
        return $this->telephonePro2;
    }

    function getClient()
    {
        return $this->client;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setTelephoneDetenteur1($telephoneDetenteur1)
    {
        $this->telephoneDetenteur1 = $telephoneDetenteur1;
    }

    function setTelephoneDetenteur2($telephoneDetenteur2)
    {
        $this->telephoneDetenteur2 = $telephoneDetenteur2;
    }

    function setTelephonePro1($telephonePro1)
    {
        $this->telephonePro1 = $telephonePro1;
    }

    function setTelephonePro2($telephonePro2)
    {
        $this->telephonePro2 = $telephonePro2;
    }

    function setClient($client)
    {
        $this->client = $client;
    }


}   //---Fin de Telephone