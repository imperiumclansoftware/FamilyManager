<?php

namespace App\Entity\banque;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="App\Repository\EmailRepository")
 * @ORM\Entity
 */
class Email
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email_pro", type="string", length=250, nullable=true)
     */
    private $emailPro;

    /**
     * @ORM\Column(name="email_perso", type="string", length=250, nullable=false)
     */
    private $emailPerso;

    /**
     * @ORM\Column(name="email_perso_conjoint", type="string", length=250, nullable=true)
     */
    private $emailPersoConjoint;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="email")
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

    function getEmailPro()
    {
        return $this->emailPro;
    }

    function getEmailPerso()
    {
        return $this->emailPerso;
    }

    function getEmailPersoConjoint()
    {
        return $this->emailPersoConjoint;
    }

    function getClient()
    {
        return $this->client;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setEmailPro($emailPro)
    {
        $this->emailPro = $emailPro;
    }

    function setEmailPerso($emailPerso)
    {
        $this->emailPerso = $emailPerso;
    }

    function setEmailPersoConjoint($emailPersoConjoint)
    {
        $this->emailPersoConjoint = $emailPersoConjoint;
    }

    function setClient($client)
    {
        $this->client = $client;
    }
}   //--- Fin de Email