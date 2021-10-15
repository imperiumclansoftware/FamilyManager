<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        //return $this->render('default/index.html.twig');
        return $this->render('indexDefault.html.twig');
    }   //--- din de la function index
}   //--- fin de la classe DefaultController
