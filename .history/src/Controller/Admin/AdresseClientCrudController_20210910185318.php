<?php

namespace App\Controller\Admin;

use App\Entity\banque\AdresseClient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdresseClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdresseClient::class;
    }


    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id'),
    //         TextField::new('N° de voie'),
    //         TextEditorField::new('description'),
    //     ];
    // }
}
