<?php

/**
 *   Pour gérer la version Administrations des Banques
 */

namespace App\Controller\banque;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\banque\AdresseBanque;
use App\Entity\banque\AgenceBanque;

/**
 * Gestion des Comptes <bancaire:></bancaire:>
 *          -   création/Modification/Suppression Compte
 *          -   Gestion des Chéquiers
 *          -   Gestion des Cartes Bancaires
 *          -
 *
 * @author Philippe Basuyau
 *
 * @Route("admin/banque")
 */
class AdminBanqueController extends AbstractController
{

    /**
     * @Route("/adminBanque", name="admin_banque_index", methods={"GET"})
     */
    public function adminBanque()
    {

        return $this->render('banque/adminBanque.html.twig');
    } //--- Fin de la fonction adminBanque

    /**
     * @Route("/etablissementBanque", name="etablissement_banque_index", methods={"GET"})
     */
    public function etablissementBanque()
    {
        $agencebanques = $this->getDoctrine()
            ->getRepository(AgenceBanque::class)
            ->findAll();

        return $this->render('banque/etablissementBanque.html.twig', ['agencebanques' => $agencebanques]);
    } //--- Fin de la fonction etablissementBanque

    /**
     * @Route("/creditImmoBanque", name="credit_immo_banque_index", methods={"GET"})
     */
    public function creditImmoBanque()
    {

        return $this->render('banque/creditMaison.html.twig');
    } //--- Fin de la fonction creditImmoBanque

    /**
     * @Route("/creditVoitureBanque", name="credit_voiture_banque_index", methods={"GET"})
     */
    public function creditVoitureBanque()
    {

        return $this->render('banque/creditVoiture.html.twig');
    } //--- Fin de la fonction creditVoitureBanque

    /**
     * @Route("/creditDiversBanque", name="credit_divers_banque_index", methods={"GET"})
     */
    public function creditDiversBanque()
    {

        return $this->render('banque/creditDivers.html.twig');
    } //--- Fin de la fonction creditDiversBanque

} //--- fin de la class AdminBanqueController
